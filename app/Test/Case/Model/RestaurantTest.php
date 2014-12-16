<?php
App::uses('Restaurant', 'Model');

/**
 * Restaurant Test Case
 *
 */
class RestaurantTest extends CakeTestCase {

  public $fixtures = array(
    'app.restaurant',
    'app.restaurant_geo',
  );

  public function setUp() {
    parent::setUp();
    $this->Restaurant = ClassRegistry::init('Restaurant');
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

  public function tearDown() {
    unset($this->Restaurant);
    parent::tearDown();
  }

  public function testConditionInRange() {
    $lat = '33.229498';
    $lng = '131.547546';
    $options = array('conditions' => Restaurant::conditionInRange($lat, $lng));
    $res = $this->Restaurant->find('all', $options);
    foreach($res as $val) {
      $this->assertTrue($val['Restaurant']['id'] <= 5);
    }
  }

}
