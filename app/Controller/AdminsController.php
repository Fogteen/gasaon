<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 27/04/2016
 * Time: 15:46
 */
App::uses('AppController', 'Controller');

class AdminsController extends AppController {

    public $uses = array('User','Ebook','Category');

    public $components = array(
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array('username' => 'username'),
                    'userModel' => 'User'
                )
            ),
            'authorize' => array('Controller')
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('login');
        if (!empty($this->Auth->user()) && $this->Auth->user('role') != 1) {
            $this->Flash->warning('Bạn không có quyền truy cập trang quản trị!');
            $this->redirect(array('controller'=>'homes')) ;
            return ;
        }
        parent::beforeFilter();
    }

    public function index()
    {
        $this->paginate = array('limit' => 1); //Phân trang với 5 item
        $this->set('admins', $this->paginate('User'));
    }

    public function login()
    {
        if($this->Auth->user('role') == 1) return $this->redirect(array('action' => 'home'));
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('role')==0) {
                    $this->Session->destroy();
                    $this->Flash->error(__('Hãy sử dụng tài khoản quản trị viên!'));
                }
                return $this->redirect(array('action' => 'home'));
            }
            $this->Flash->error(__('Tài khoản hoặc mật khẩu không đúng. Hãy thử lại!'));
        }
    }

    public  function home() {
        //$this->Session->write('account', $this->Auth->user());
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Thêm tài khoản thành công'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Flash->error(
                __('Xảy ra lỗi')
            );
        }
    }

    public function listuser() {
        $list_user = $this->User->find('all',array(
           'order' => array('User.role DESC')
        ));
        $this->set('ls',$list_user);
    }
}