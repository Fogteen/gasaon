<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 21/03/2016
 * Time: 09:26
 */

class Ebook extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'categories_id'
        )
    );
    public $hasMany = array(
        'Request' => array(
            'className' => 'Request',
            'foreignKey' => 'ebook_id'
        ),
        'Rating' => array(
            'className' => 'Rating',
            'foreignKey' => 'user_id'
        )
    );

    public $actsAs = array(
        'Upload.Upload' => array(
            'picture' => array(
                'thumbnailSizes' => array(
                    'thumb' => '200x259'
                ),
            )
        )
    );


    public $validate = array(
        'title' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Title không đưuọc trống!'
            )
        ),
        'des' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Title không đưuọc trống!'
            )
        ),
        'author' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Title không đưuọc trống!'
            )
        )
    );
}