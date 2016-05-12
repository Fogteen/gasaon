<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 11/05/2016
 * Time: 10:25
 */

App::uses('AppModel', 'Model');

class Downloader extends AppModel {


    public $belongsTo = array(
        'Ebook' => array(
            'className' => 'Ebook',
            'foreignKey' => 'book',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}