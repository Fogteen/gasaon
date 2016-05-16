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
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'Request' => array(
            'className' => 'Request',
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'Nofication' => array(
            'className' => 'Nofication',
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'Rating' => array(
            'className' => 'Rating',
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'Friend1' => array(
            'className' => 'Friend',
            'foreignKey' => 'user_one_id',
            'dependent' => true
        ),
        'Friend2' => array(
            'className' => 'Friend',
            'foreignKey' => 'user_two_id',
            'dependent' => true
        ),
        'Message1' => array(
            'className' => 'Message',
            'foreignKey' => 'from',
            'dependent' => true
        ),
        'Message2' => array(
            'className' => 'Message',
            'foreignKey' => 'to',
            'dependent' => true
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
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Tên tài khoản không đưuọc trống!'
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