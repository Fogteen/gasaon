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

    public $helpers = array('Html', 'Form', 'Paginator');

    /*
     * Cho phép thực hiện các action khi chưa đăng nhập
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
        $this->Auth->allow('fblogin', 'fb_login');
        if (!$this->Auth->loggedIn()) {
            $this->Auth->authError = false;
        }
    }

//    Kiểm tra đăng nhập
    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Username hoặc password không đúng'));
        }
    }

    /**
     * Facebook Login
     */
    public function fblogin()
    {
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
        if (isset($_SESSION['token'])){
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
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->redirect(array('action' => 'login'));
                    }
                } else { // Nếu chưa thì lấy thông tin lưu vào CSDL và đăng nhập
                    $data['email'] = $fb_data['email'];
                    $data['first_name'] = $fb_data['first_name'];
                    $data['last_name'] = $fb_data['last_name'];
                    $data['social_id'] = $fb_data['id'];
                    $data['picture'] = 'graph.facebook.com/' . $id . '/picture?width=100';
                    $this->User->save($data);
                    if ($this->User->save($data)) {
                        if ($this->Auth->login($data)) {
                            $this->Session->write('user', $this->Auth->user('email'));
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->redirect(array('action' => 'login'));
                        }
                    } else {
                        $this->redirect(array('action' => 'login'));
                    }
                }
            } else {
                $this->redirect(array('action' => 'login'));
            }
        }
    }
    // end Facebook login

    //Đăng xuất
    public function logout()
    {
        $this->Session->destroy();//Hủy tất cả session
        return $this->redirect($this->Auth->logout());
    }

    //Trang index
    public function index()
    {
        $this->paginate = array('limit' => 5); //Phân trang với 5 item
        $this->set('users', $this->paginate('User'));
    }

    public function view($id = null)
    {
        if (empty($this->User->findById($id))) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->set('user', $this->User->findById($id));
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Thêm tài khoản thành công'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Xảy ra lỗi')
            );
        }
    }

    public function edit($id = null)
    {

        if (empty($this->User->findById($id))) {
            $this->Flash->error(__("Không tìm thấy dữ liệu"));
            return $this->redirect(array('action' => 'index'));
        }
        elseif ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if($this->User->save($this->request->data))
                $this->request->data['User']['picture']['remove'] = null;
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Cập nhật thành công'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Đã xảy ra lỗi')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
            $this->set('user', $this->request->data);
        }
    }

    public function delete($id = null)
    {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
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

    public function nofi() {
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
        return new CakeResponse(array('body' => json_encode($data),'type'=>'json'));
    }

    public function nofiup() {
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
        $this->User->Request->updateAll(
            array('Request.status' => 3),
            array('Request.id' => $request_id)
        );
        $request = $this->User->Request->read(null,$request_id);
        if($status != 21) {
            $this->User->Nofication->create();
            $this->User->Nofication->save(array(
                'user_id' => $request['Request']['user_id'],
                'ebook_id' => $ebook_id,
                'request_id' => $request_id,
                'content' => 'Yêu cầu về cuốn sách ' . $request['Ebook']['title'] . ' của bạn đã được chấp nhận',
                'status' => 2
            ));
        }
        return;
    }
}

