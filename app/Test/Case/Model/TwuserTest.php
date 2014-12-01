<?php
App::uses('Twuser', 'Model');

/**
 * Twuser Test Case
 *
 */
class TwuserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.twuser'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Twuser = ClassRegistry::init('Twuser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Twuser);

		parent::tearDown();
	}

}
