<?php
App::uses('MenuTag', 'Model');

/**
 * MenuTag Test Case
 *
 */
class MenuTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenuTag = ClassRegistry::init('MenuTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuTag);

		parent::tearDown();
	}

}
