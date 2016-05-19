<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 04/03/2016
 * Time: 09:40
 */
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');


require_once("../Vendor/facebook/autoload.php");

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;


class UsersController extends AppController
{
    public $uses = array('User', "Message");

    public $components = array(
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array('username' => 'email')
                )
            ),
            'authorize' => array('Controller'),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
            )
        ),
        'Session'
    );

    /*
     * Cho phép thực hiện các action khi chưa đăng nhập
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add','login','fblogin', 'fb_login');
        if (!$this->Auth->loggedIn()) {
            $this->Auth->authError = false;
        }
    }

//    Kiểm tra đăng nhập
    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array('controller' => 'homes'));
            }
            $this->Flash->error(__('Tài khoản hoặc mật khẩu không đúng'));
        }
    }

    /**
     * Facebook Login
     */
    public function fblogin()
    {
        session_start();
        $this->autoRender = false; //Không dùng view
        Facebook\FacebookSession::setDefaultApplication(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET); //Cung cấp facebook id và secret
        $helper = new Facebook\FacebookRedirectLoginHelper(FACEBOOK_REDIRECT_URI); //Kết nối
        $url = $helper->getLoginUrl(array('email'));
        $this->redirect($url);
    }

    public function fb_login()
    {
        Facebook\FacebookSession::setDefaultApplication(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
        $helper = new Facebook\FacebookRedirectLoginHelper(FACEBOOK_REDIRECT_URI);
        $session = $helper->getSessionFromRedirect(); //Lấy thông tin session
        if (isset($_SESSION['token'])) {
            $session = new Facebook\FacebookSession($_SESSION['token']); //nếu đã có token trong session thì sử dụng nó
            try {
                $session->validate(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
            } catch (Facebook\FacebookAuthorizationException $e) {
                echo $e->getMessage();
            }
        }
        $data = array();
        $fb_data = array();
        if (isset($session)) {
            $_SESSION['token'] = $session->getToken(); //lấy token nếu chưa có
            $request = new Facebook\FacebookRequest($session, 'GET', '/me?fields=first_name,last_name,email');
            $response = $request->execute();
            $graph = $response->getGraphObject(Facebook\GraphUser::className());
            $fb_data = $graph->asArray();
            $id = $graph->getId();
            if (!empty($fb_data)) {
                $result = $this->User->findByEmail($fb_data['email']);//Kiểm tra người dùng đã từng đăng nhập hay chưa
                if (!empty($result)) {
                    if ($this->Auth->login($result['User'])) { //Nếu có thì đăng nhập ngay
                        $this->Session->write('user', $this->Auth->user('email'));
                        $this->redirect(array('controller' => 'homes'));
                    } else {
                        $this->redirect(array('controller' => 'homes'));
                    }
                } else { // Nếu chưa thì lấy thông tin lưu vào CSDL và đăng nhập
                    $data['email'] = $fb_data['email'];
                    $data['username'] = $fb_data['first_name'].' '.$fb_data['last_name'];
                    $data['social_id'] = $fb_data['id'];
                    $data['picture'] = 'graph.facebook.com/' . $id . '/picture?width=100';
                    if ($this->User->save($data)) {
                        if ($this->Auth->login($data)) {
                            $this->Session->write('user', $this->Auth->user('email'));
                            $this->redirect(array('controller' => 'homes'));
                        } else {
                            $this->redirect(array('controller' => 'homes'));
                        }
                    } else {
                        $this->redirect(array('controller' => 'homes'));
                    }
                }
            } else {
                $this->redirect(array('controller' => 'homes'));
            }
        }
    }
    // end Facebook login

    //Đăng xuất
    public function logout()
    {
        $this->Session->destroy();//Hủy tất cả session
        return $this->redirect(array('controller' => 'homes'));
    }

    public function view($id = null)
    {
        $user = $this->User->findById($id);
        if (empty($user)) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('controller' => 'homes'));
        } else {
            $this->set('user', $user);
            $this->set('friend', $this->User->Friend1->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        array('Friend1.user_one_id' => $id),
                        array('Friend1.user_two_id' => $id)
                    ),
                    'Friend1.status' => 1
                )
            )));
            $this->set('status', $this->User->Friend1->find('first', array(
                'conditions' => array(
                    'OR' => array(
                        array('Friend1.user_one_id' => $id, 'Friend1.user_two_id' => $this->Auth->user('id')),
                        array('Friend1.user_two_id' => $id, 'Friend1.user_one_id' => $this->Auth->user('id'))
                    )
                )
            )));
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Đăng ký tài khoản thành công'));
                return $this->redirect(array('action' => 'homes'));
            }
            $this->Flash->error(
                __('Xảy ra lỗi')
            );
        }
    }

    public function edit($id = null)
    {
        $user = $this->User->findById($id);
        if (empty($user)) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('controller' => 'homes'));
        } elseif ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                if (!empty($this->request->data['User']['picture']) && $this->request->data['User']['picture']['name'] != '' && $this->request->data['User']['picture']['name'] != $user['User']['picture']) {
                    if (file_exists(WWW_ROOT . 'files/user/picture/' . $user['User']['picture_dir'] . '/' . $user['User']['picture']))
                        unlink(WWW_ROOT . 'files/user/picture/' . $user['User']['picture_dir'] . '/' . $user['User']['picture']);
                    if (file_exists(WWW_ROOT . 'files/user/picture/' . $user['User']['picture_dir'] . '/thumb_' . $user['User']['picture']))
                        unlink(WWW_ROOT . 'files/user/picture/' . $user['User']['picture_dir'] . '/thumb_' . $user['User']['picture']);
                }
                $this->Flash->success(__('Cập nhật thành công'));
                return $this->redirect(array('action' => 'view',$id));
            }
            $this->Flash->error(
                __('Đã xảy ra lỗi')
            );
        } else {
            $this->request->data = $user;
            unset($this->request->data['User']['password']);
            //$this->set('user', $this->request->data);
        }
    }

    public function delete($id = null)
    {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');
        if ($this->Auth->user('id') != $id) {
            $this->Flash->error(__('Bạn không có quyền thực hiện'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            if (file_exists(WWW_ROOT.'files/'.$id)) rmdir(WWW_ROOT.'files/'.$id);
            $this->Flash->success(__('Xóa thành công'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Xảy ra lỗi'));
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user)
    {
        // Chỉ cho phép edit tài khoản của chính mình
        if (in_array($this->action, array('edit'))) {
            $userId = (int)$this->request->params['pass'][0];
            if ($userId == $this->Auth->user('id')) {
                return true;
            } else {
                $this->Flash->error(__('Bạn không có quyền truy cập'));
                return $this->redirect(array('action' => 'index'));
            }
        }

        return parent::isAuthorized($user);
    }

    public function nofi()
    {
        $this->autoRender = false;
        $this->layout = false;
        $data = $this->User->Nofication->find('all', array(
            'conditions' => array(
                'Nofication.user_id' => $this->Auth->user('id'),
                'OR' => array(
                    array('Nofication.status' => 0),
                    array('Nofication.status' => 2)
                )
            )
        ));
        return new CakeResponse(array('body' => json_encode($data), 'type' => 'json'));
    }

    public function nofidel()
    {
        $this->autoRender = false;
        $this->layout = false;
        $id = $this->request->data['id'];
        if ($id != 0)
            $this->User->Nofication->delete($id);
        return;
    }

    public function nofiup()
    {
        $this->autoRender = false;
        $this->layout = false;
        $id = $this->request->data['id'];
        $status = $this->request->data['status'];
        $request_id = $this->request->data['request_id'];
        $ebook_id = $this->request->data['ebook_id'];
        $this->User->Nofication->updateAll(
            array('Nofication.status' => $status),
            array('Nofication.id' => $id)
        );
        if (empty($ebook_id)) {
            $this->User->Friend1->updateAll(
                array('Friend1.status' => 1),
                array('Friend1.id' => $request_id)
            );
            $friend = $this->User->Friend1->read(null, $request_id);
            $user = $this->User->read(null, $friend['Friend1']['user_two_id']);
            if ($status != 21) {
                $this->User->Nofication->create();
                $this->User->Nofication->save(array(
                    'user_id' => $friend['Friend1']['user_one_id'],
                    'ebook_id' => $ebook_id,
                    'request_id' => $request_id,
                    'content' => $user['User']['username'] . ' đã chấp nhận yêu cầu kết bạn.',
                    'status' => 2
                ));

                $pusher = new Pusher('ea2f5e5013baa43a541f', 'bd3a393da392412204cf', '197077');

                // trigger on _channel' an event called '_event' with this payload:

                $data = array(
                    'user_id' => $friend['Friend1']['user_one_id'],
                    'user_send' => $user['User']['username'],
                );
                $pusher->trigger('request_channel', 'rei_friend_event', $data);
            }
        } else {
            $this->User->Request->updateAll(
                array('Request.status' => 3),
                array('Request.id' => $request_id)
            );
            $request = $this->User->Request->read(null, $request_id);
            if ($status != 21) {
                $this->User->Nofication->create();
                $this->User->Nofication->save(array(
                    'user_id' => $request['Request']['user_id'],
                    'ebook_id' => $ebook_id,
                    'request_id' => $request_id,
                    'content' => 'Yêu cầu về cuốn sách ' . $request['Ebook']['title'] . ' của bạn đã được chấp nhận',
                    'status' => 2
                ));


                $pusher = new Pusher('ea2f5e5013baa43a541f', 'bd3a393da392412204cf', '197077');

                // trigger on _channel' an event called '_event' with this payload:

                $data = array(
                    'user_id' => $request['Request']['user_id'],
                    'title' => $request['Ebook']['title'],
                );
                $pusher->trigger('request_channel', 'rei_event', $data);
            }
        }

        return;
    }

    public function addfriend()
    {
        $this->layout = false;
        $this->autoRender = false;
        $user_one_id = $this->request->data['user_one_id'];
        $user_two_id = $this->request->data['user_two_id'];
        $user = $this->User->read(null, $user_one_id);
        $this->User->Friend1->create();
        $this->User->Friend1->save(array(
            'user_one_id' => $this->Auth->user('id'),
            'user_two_id' => $user_two_id,
            'action_user' => $this->Auth->user('id'),
            'status' => 0
        ));
        $this->User->Nofication->create();
        $this->User->Nofication->save(array(
            'user_id' => $user_two_id,
            'ebook_id' => '',
            'request_id' => $this->User->Friend1->id,
            'content' => 'Bạn nhận được một yêu cầu kết bạn từ ' . $user['User']['username']
        ));
        $pusher = new Pusher('ea2f5e5013baa43a541f', 'bd3a393da392412204cf', '197077');

        // trigger on _channel' an event called '_event' with this payload:

        $data = array(
            'user_id' => $user_two_id,
            'user_send' => $user['User']['username']
        );
        $pusher->trigger('request_channel', 'send_friend_event', $data);
    }

    public function unfriend()
    {
        $this->layout = false;
        $this->autoRender = false;
        $id = $this->request->data['id'];
        if ($id != 0)
            $this->User->Friend1->delete($id);
        return;
    }

    public function frlist()
    {
        $this->layout = false;
        $this->autoRender = false;
        $friend = $this->User->Friend1->find('all', array(
            'conditions' => array(
                'OR' => array(
                    array('Friend1.user_one_id' => $this->Auth->user('id')),
                    array('Friend1.user_two_id' => $this->Auth->user('id'))
                ),
                'Friend1.status' => 1
            )
        ));
        $i = 0;
        foreach ($friend as $fr) {
            if ($fr['Friend1']['user_one_id'] == $this->Auth->user('id')) {
                $user = $this->User->read(null, $fr['Friend1']['user_two_id']);
            } else {
                $user = $this->User->read(null, $fr['Friend1']['user_one_id']);
            }
            $data[$user['User']['id']] = array($user['User']['id'] => array($user['User']['username'], 'thumb_' . $user['User']['picture'], ''));
        }
        return new CakeResponse(array('body' => json_encode($data), 'type' => 'json'));
    }

    public function chatauth()
    {
        $this->layout = false;
        $this->autoRender = false;
        $name = $this->Auth->user('username'); // chose the way to get this get,post session ...etc
        $user_id = $this->Auth->user('id'); // chose the way to get this get,post session ...etc
        $channel_name = $this->request->data('channel_name'); // never change
        $socket_id = $this->request->data('socket_id'); // never change


        $pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
        $presence_data = array('name' => $name);
        echo $pusher->presence_auth($channel_name, $socket_id, $user_id, $presence_data);
    }

    public function chat()
    {
        $this->layout = false;
        $this->autoRender = false;
        $pusher = new Pusher(APP_KEY, APP_SECRET, APP_ID);
        if ($_POST['typing'] == "false" && $_POST['msg'] != '') {
            $pusher->trigger('presence-mychanel', 'send-event', array('message' => htmlspecialchars($_POST['msg']), 'from' => $_POST['from'], 'to' => str_replace('#', '', $_POST['to'])));
            $this->Message->create();
            $mess['to'] = str_replace('#', '', $_POST['to']);
            $mess['from'] = $_POST['from'];
            $mess['message'] = htmlspecialchars($_POST['msg']);
            $this->Message->save($mess);
        } else if ($_POST['typing'] == "true")
            $pusher->trigger('presence-mychanel', 'typing-event', array('message' => $_POST['typing'], 'from' => $_POST['from'], 'to' => str_replace('#', '', $_POST['to'])));
        else {
            $pusher->trigger('presence-mychanel', 'typing-event', array('message' => 'null', 'from' => $_POST['from'], 'to' => str_replace('#', '', $_POST['to'])));
        }
    }

    public function getmess()
    {
        $this->layout = false;
        $this->autoRender = false;
        $from = $this->request->data['from'];
        $to = $this->request->data['to'];
        $data = $this->Message->find('all', array(
            'OR' => array(
                array(
                    'Message.to' => $to,
                    'Message.from' => $from
                ),
                array(
                    'Message.from' => $to,
                    'Message.to' => $from
                )
            )
        ));
        return new CakeResponse(array('body' => json_encode($data), 'type' => 'json'));
    }

}

