<?php
App::uses('AppModel', 'Model');
/**
 * View Model
 *
 */
class Viewer extends AppModel {


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
