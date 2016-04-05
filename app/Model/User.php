<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 15/03/2016
 * Time: 10:25
 */

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $hasMany = array(
        'Ebook' => array(
            'className' => 'Ebook',
            'foreignKey' => 'user_id'
        )
    );

    public $actsAs = array(
        'Upload.Upload' => array(
            'picture' => array(
                'fields' => array(
                    'dir' => 'picture_dir'
                ),
                'thumbnailSizes' => array(
                    'thumb' => '50x50'
                ),
            )
        )
    );

    public $validate = array(
        'first_name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Firstname không đưuọc trống!'
            )
        ),
        'last_name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Lastname không đưuọc trống!'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Email không đưuọc trống!'
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