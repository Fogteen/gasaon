<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 19/04/2016
 * Time: 10:41
 */

class Friend extends AppModel {


    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User1' => array(
            'className' => 'User',
            'foreignKey' => 'user_one_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User2' => array(
            'className' => 'User',
            'foreignKey' => 'user_two_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
