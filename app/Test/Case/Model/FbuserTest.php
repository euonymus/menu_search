<?php
App::uses('Fbuser', 'Model');

/**
 * Fbuser Test Case
 *
 */
class FbuserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fbuser'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Fbuser = ClassRegistry::init('Fbuser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fbuser);

		parent::tearDown();
	}

}
