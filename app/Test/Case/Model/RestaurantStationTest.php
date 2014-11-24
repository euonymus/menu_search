<?php
App::uses('RestaurantStation', 'Model');

/**
 * RestaurantStation Test Case
 *
 */
class RestaurantStationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.restaurant_station',
		'app.restaurant',
		'app.station'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RestaurantStation = ClassRegistry::init('RestaurantStation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RestaurantStation);

		parent::tearDown();
	}

}
