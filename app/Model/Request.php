<?php
App::uses('AppModel', 'Model');
/**
 * Request Model
 *
 * @property User $User
 * @property Ebook $Ebook
 */
class Request extends AppModel {


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
