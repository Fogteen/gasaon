<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 30/03/2016
 * Time: 10:28
 */

class Category extends AppModel {

    public $hasMany = array(
        'Book' => array(
            'className' => 'Ebook',
            'foreignKey' => 'categories_id',
            'dependent' => true
        )
    );
}