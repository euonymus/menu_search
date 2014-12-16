<?php
App::uses('RestaurantGeo', 'Model');

/**
 * RestaurantGeo Test Case
 *
 */
class RestaurantGeoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
  public $fixtures = array(
    'app.restaurant_geo'
  );

/**
 * setUp method
 *
 * @return void
 */
  public function setUp() {
    parent::setUp();
    $this->RestaurantGeo = ClassRegistry::init('RestaurantGeo');

    // Because PhpUnit does not support GEOMETRY MySQL Type, this mannually alter the table and prepare
    $alter = 'ALTER TABLE `restaurant_geos` CHANGE `geo` `geo` GEOMETRY  NOT NULL';
    $this->RestaurantGeo->query($alter);
    // Prepare Data. Do not write in Fixture. Because PhpUnit doesn't support geometry data.
    $data = array(
        array(
		  'id' => 1,
		  'lat' => '33.229498',
		  'lng' => '131.547546',
        ),
	array(
		  'id' => 2,
		  'lat' => '33.229499',
		  'lng' => '131.547547',
        ),
	array(
		  'id' => 3,
		  'lat' => '33.229508',
		  'lng' => '131.547556',
        ),
	array(
		  'id' => 4,
		  'lat' => '33.229598',
		  'lng' => '131.547646',
        ),
	array(
		  'id' => 5,
		  'lat' => '33.230498',
		  'lng' => '131.548546',
        ),
	array(
		  'id' => 6,
		  'lat' => '33.239498',
		  'lng' => '131.557546',
        ),
	array(
		  'id' => 7,
		  'lat' => '33.329498',
		  'lng' => '131.647546',
        ),
	array(
		  'id' => 8,
		  'lat' => '34.229498',
		  'lng' => '132.547546',
        ),
    );
    foreach($data as $val) {
      $this->RestaurantGeo->save($val);
    }
  }

/**
 * tearDown method
 *
 * @return void
 */
  public function tearDown() {
    unset($this->RestaurantGeo);
    parent::tearDown();
  }

  public function testSetFieldDistanceFrom() {
    $lat = '33.229498';
    $lng = '131.547546';
    RestaurantGeo::setFieldDistanceFrom($lat, $lng);
    $instance = RestaurantGeo::getInstance();
    $this->assertTrue(array_key_exists('distance', $instance->virtualFields));
  }

  public function testConditionInRange() {
    $lat = '33.229498';
    $lng = '131.547546';
    $options = array('conditions' => RestaurantGeo::conditionInRange($lat, $lng));
    $data = $this->RestaurantGeo->find('all', $options);
    foreach ($data as $val) {
      $this->assertTrue(is_numeric($val['RestaurantGeo']['distance']));
      $this->assertTrue($val['RestaurantGeo']['distance'] < 500);
    }
  }

  public function testConditionInRange2() {
    $lat = '33.229498';
    $lng = '131.547546';
    $options = array('conditions' => RestaurantGeo::conditionInRange2($lat, $lng));
    $data = $this->RestaurantGeo->find('all', $options);
    foreach ($data as $val) {
      $this->assertTrue($val['RestaurantGeo']['id'] <= 5);
    }
  }
}
