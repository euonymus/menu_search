<?php
App::uses('Station', 'Model');

/**
 * Station Test Case
 *
 */
class StationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.station'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Station = ClassRegistry::init('Station');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Station);

		parent::tearDown();
	}

}
