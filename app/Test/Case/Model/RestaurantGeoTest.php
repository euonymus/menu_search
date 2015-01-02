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
		  'latitude' => '33.229498',
		  'longitude' => '131.547546',
        ),
	array(
		  'id' => 2,
		  'latitude' => '33.229499',
		  'longitude' => '131.547547',
        ),
	array(
		  'id' => 3,
		  'latitude' => '33.229508',
		  'longitude' => '131.547556',
        ),
	array(
		  'id' => 4,
		  'latitude' => '33.229598',
		  'longitude' => '131.547646',
        ),
	array(
		  'id' => 5,
		  'latitude' => '33.230498',
		  'longitude' => '131.548546',
        ),
	array(
		  'id' => 6,
		  'latitude' => '33.239498',
		  'longitude' => '131.557546',
        ),
	array(
		  'id' => 7,
		  'latitude' => '33.329498',
		  'longitude' => '131.647546',
        ),
	array(
		  'id' => 8,
		  'latitude' => '34.229498',
		  'longitude' => '132.547546',
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

  public function testSave() {
    // NG: geo = NULL
    $data = array(
		  'id' => 9,
		  'latitude' => NULL,
		  'longitude' => NULL,
    );
    $res = $this->RestaurantGeo->save($data);
    $expected = array('latitude' => array('0' => 'notEmpty'), 'longitude' => array('0' => 'notEmpty'));
    $this->assertIdentical($this->RestaurantGeo->validationErrors, $expected);
  }

  public function testSetFieldDistanceFrom() {
    $latitude = '33.229498';
    $longitude = '131.547546';
    RestaurantGeo::setFieldDistanceFrom($latitude, $longitude);
    $instance = RestaurantGeo::getInstance();
    $this->assertTrue(array_key_exists('distance', $instance->virtualFields));
  }

  public function testConditionInRange() {
    $latitude = '33.229498';
    $longitude = '131.547546';
    $options = array('conditions' => RestaurantGeo::conditionInRange($latitude, $longitude));
    $data = $this->RestaurantGeo->find('all', $options);
    foreach ($data as $val) {
      $this->assertTrue(is_numeric($val['RestaurantGeo']['distance']));
      $this->assertTrue($val['RestaurantGeo']['distance'] < 500);
    }
  }

  public function testConditionInRange2() {
    $latitude = '33.229498';
    $longitude = '131.547546';
    $options = array('conditions' => RestaurantGeo::conditionInRange2($latitude, $longitude));
    $data = $this->RestaurantGeo->find('all', $options);
    foreach ($data as $val) {
      $this->assertTrue($val['RestaurantGeo']['id'] <= 5);
    }
  }
}
