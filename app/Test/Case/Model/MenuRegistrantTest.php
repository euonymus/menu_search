<?php
App::uses('MenuRegistrant', 'Model');

/**
 * MenuRegistrant Test Case
 *
 */
class MenuRegistrantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu_registrant',
		'app.menu',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenuRegistrant = ClassRegistry::init('MenuRegistrant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuRegistrant);

		parent::tearDown();
	}

}
