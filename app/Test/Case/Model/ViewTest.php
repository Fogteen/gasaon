<?php
App::uses('View', 'Model');

/**
 * View Test Case
 */
class ViewTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.view'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->View = ClassRegistry::init('View');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->View);

		parent::tearDown();
	}

}
