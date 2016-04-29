<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 27/04/2016
 * Time: 15:38
 */

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class Admin extends AppModel {

    public $useTable = false;

    public $validate = array(
        'user_name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Username không đưuọc trống!'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password không được trống'
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}