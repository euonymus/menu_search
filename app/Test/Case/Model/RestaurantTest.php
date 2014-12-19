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

  public function tearDown() {
    unset($this->Restaurant);
    parent::tearDown();
  }

  public function testConditionInRange() {
    $latitude = '33.229498';
    $longitude = '131.547546';
    $options = array('conditions' => Restaurant::conditionInRange($latitude, $longitude));
    $res = $this->Restaurant->find('all', $options);
    foreach($res as $val) {
      $this->assertTrue($val['Restaurant']['id'] <= 5);
    }
  }

  public function testGetLikelihood() {
    $data = array(
      'Restaurant' => array(
        'name' => '橙 daidai',
       ),
      'RestaurantGeo' => array(
        'latitude' => '35.64594541953124',
	'longitude' => '139.7080492973328',
      ),
    );
    $res = $this->Restaurant->getLikelihood($data);
  }

}
