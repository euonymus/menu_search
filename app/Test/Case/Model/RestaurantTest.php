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

    $latitude = '';
    $longitude = '';
    $res = Restaurant::conditionInRange($latitude, $longitude, 30);
    $this->assertFalse($res);
  }

  public function testGetLikelihood() {
    // NG: not an array
    $data = false;
    $res = $this->Restaurant->getLikelihood($data);
    $this->assertIdentical($res, false);
    // NG: Restaurant is not an array
    $data = array('Restaurant' => false);
    $res = $this->Restaurant->getLikelihood($data);
    $this->assertIdentical($res, false);
    // NG: name does not exist
    $data = array();
    $res = $this->Restaurant->getLikelihood($data);
    $this->assertIdentical($res, false);

    // NG: RestaurantGeo is not an array
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant4'
      ),
      'RestaurantGeo' => false
    );
    $res = $this->Restaurant->getLikelihood($data);
    //$this->assertIdentical($res['Restaurant']['name'], $data['Restaurant']['name']);
    $this->assertIdentical($res, false);

    // OK: without RestaurantGeo
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant5'
      ),
    );
    $res = $this->Restaurant->getLikelihood($data);
    //$this->assertIdentical($res['Restaurant']['name'], $data['Restaurant']['name']);
    $this->assertIdentical($res, false);

    // OK: 名前,場所完全一致。
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant3',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.229508',
	'longitude' => '131.547556',
      ),
    );
    $res = $this->Restaurant->getLikelihood($data);
    $this->assertIdentical($res['Restaurant']['name'], $data['Restaurant']['name']);
    $this->assertIdentical($res['RestaurantGeo']['latitude'], $data['RestaurantGeo']['latitude']);

    // OK: in the range of 30 meter
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant6',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.239768',
        'longitude' => '131.557546',
      ),
    );
    $res = $this->Restaurant->getLikelihood($data);
    $this->assertIdentical($res['Restaurant']['name'], $data['Restaurant']['name']);

    // empty: out of the range of 30 meter
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant6',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.239769',
        'longitude' => '131.557546',
      ),
    );
    $res = $this->Restaurant->getLikelihood($data);
    $this->assertIdentical($res, array());

    // empty: name doesn't exist
    $data = array(
      'Restaurant' => array(
        'name' => 'hogen',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.239498',
        'longitude' => '131.557546',
      ),
    );
    $res = $this->Restaurant->getLikelihood($data);
    $this->assertIdentical($res, array());
  }

  public function testSaveIfNotExist() {
    // NG: Geo is NULL
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant6',
       ),
      'RestaurantGeo' => array(
        'latitude' => NULL,
        'longitude' => NULL,
      ),
    );
    $res = $this->Restaurant->saveIfNotExist($data);
    $this->assertFalse($res);
    $expected = array('geo'=>array('レストランの場所を指定してください'));
    $this->assertIdentical($this->Restaurant->validationErrors, $expected);
    $this->Restaurant->create(); // 以降のtestで $this->Restaurant->invalidate() をリフレッシュするため

    // NG: Data RestaurantGeo is empty
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant6',
       ),
      'RestaurantGeo' => array(
        'latitude' => '',
        'longitude' => '',
      ),
    );
    $res = $this->Restaurant->saveIfNotExist($data);
    //$this->assertIdentical($res, '6');
    $this->assertFalse($res);
    $expected = array('geo'=>array('レストランの場所を指定してください'));
    $this->assertIdentical($this->Restaurant->validationErrors, $expected);
    $this->Restaurant->create(); // 以降のtestで $this->Restaurant->invalidate() をリフレッシュするため

    // NG: Data without RestaurantGeo
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant6',
       ),
    );
    $res = $this->Restaurant->saveIfNotExist($data);
    //$this->assertIdentical($res, '6');
    $expected = array('geo'=>array('レストランの場所を指定してください'));
    $this->assertIdentical($this->Restaurant->validationErrors, $expected);
    $this->Restaurant->create(); // 以降のtestで $this->Restaurant->invalidate() をリフレッシュするため

    // OK: Data exists and receive the id of it
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant6',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.239768',
        'longitude' => '131.557546',
      ),
    );
    $res = $this->Restaurant->saveIfNotExist($data);
    $this->assertIdentical($res, '6');

    // OK: Data does not exist and recieve the inserted id of the new record
    $data = array(
      'Restaurant' => array(
        'name' => 'new restaurant',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.239768',
        'longitude' => '131.557546',
      ),
    );
    $res = $this->Restaurant->saveIfNotExist($data);
    // the result depends on the Fixture. If the biggest number of id on fixture changes, below should be modified.
    $this->assertIdentical($res, '10');
    // check if the tables are saved properly
    $after = $this->Restaurant->find('first', array('conditions' => Restaurant::conditionById($res)));
    $this->assertIdentical($after['Restaurant']['name'], $data['Restaurant']['name']);
    $this->assertIdentical($after['RestaurantGeo']['latitude'], $data['RestaurantGeo']['latitude']);

  }

  public function testNearList() {
    $latitude = '33.229508';
    $longitude = '131.547556';
    $res = $this->Restaurant->nearList($latitude, $longitude);
    $this->assertIdentical($res, array('restaurant1'=>'restaurant1','restaurant2'=>'restaurant2','restaurant3'=>'restaurant3','restaurant4'=>'restaurant4'));
  }

}
