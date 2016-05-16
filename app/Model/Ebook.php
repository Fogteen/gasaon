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
            'foreignKey' => 'ebook_id',
            'dependent' => true
        ),
        'Rating' => array(
            'className' => 'Rating',
            'foreignKey' => 'ebook_id',
            'dependent' => true
        ),
        'Nofication' => array(
            'className' => 'Nofication',
            'foreignKey' => 'ebook_id',
            'dependent' => true
        ),
        'Viewer' => array(
            'className' => 'Viewer',
            'foreignKey' => 'book',
            'dependent' => true
        ),
        'Downloader' => array(
            'className' => 'Downloader',
            'foreignKey' => 'book',
            'dependent' => true
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
                'message' => 'Tiêu đề không đưuọc trống!'
            )
        ),
        'des' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Mô tả không đưuọc trống!'
            )
        ),
        'author' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Tác giả không đưuọc trống!'
            )
        ),
        'categories_id' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Hãy chọn danh mục!'
            )
        ),
        'publish' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Hãy chọn chế độ chia sẻ'
            )
        )
    );
}