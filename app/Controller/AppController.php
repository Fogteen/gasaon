<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('User','Ebook');
    public $components = array(
        'Flash',
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array('username' => 'email')
                )
            ),
            'authorize' => array('Controller') // Added this line
        )
    );

    public function isAuthorized($user) {
        // Default deny
        return true;
    }

    public function beforeFilter() {
        if (empty($this->Auth->user('id'))) $this->layout='nologin';
        else $this->layout='login';
        $this->set('account',$this->User->findById($this->Auth->user('id')));
        $this->set('nofi',$this->User->Nofication->find('all',array(
            'conditions' => array(
                'Nofication.user_id' => $this->Auth->user('id'),
                'OR' => array(
                    array('Nofication.status' => 0),
                    array('Nofication.status' => 2)
                )
            )
        )));
        $this->Auth->allow('index', 'view', 'add', 'upload', 'delete', 'deleteup');
    }
}
