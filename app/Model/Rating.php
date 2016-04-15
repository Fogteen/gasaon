<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 15/04/2016
 * Time: 10:11
 */

class Rating extends AppModel {


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Ebook' => array(
            'className' => 'Ebook',
            'foreignKey' => 'ebook_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
