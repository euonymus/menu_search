<?php
App::uses('Menu', 'Model');

/**
 * Menu Test Case
 *
 */
class MenuTest extends CakeTestCase {

  public $fixtures = array(
    'app.menu',
    'app.menu_user',
    'app.restaurant',
    'app.restaurant_geo',
  );

  public function setUp() {
    parent::setUp();
    $this->Menu = ClassRegistry::init('Menu');
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
    unset($this->Menu);

    parent::tearDown();
  }

  public function testUpdatePoint() {
    $menuId = 2;
    $res = $this->Menu->updatePoint($menuId);
    $this->assertFalse(empty($res));

    $data = $this->Menu->findById($menuId, array('point'));
    $this->assertIdentical($data['Menu']['point'], '3');
  }

  public function testCsvParser() {
    // Parsed all model data
    $csv = '橙 daidai,35.64594541953124,139.7080492973328,本日の麺セット,日替り麺・日替り小丼・サラダ・漬物,"改行のテスト
正しくパースされるといいな",,1,,900,"日替り麺,日本食",';
    $res = Menu::csvParser($csv);
    $expected = array(
      'Restaurant' => array(
        'name' => '橙 daidai',
       ),
      'RestaurantGeo' => array(
        'latitude' => '35.64594541953124',
	'longitude' => '139.7080492973328',
      ),
      'Menu' => array(
        'name' => '本日の麺セット',
	'description' => '日替り麺・日替り小丼・サラダ・漬物',
	'remarks' => '改行のテスト
正しくパースされるといいな',
	'combo' => false,
	'lunch' => true,
	'dinner' => false,
	'price' => '900',
	'tags' => '日替り麺,日本食',
	'image' => '',
      )
    );
    $this->assertIdentical($res, $expected);

    // without latlng
    $csv = '橙 daidai,,,本日の麺セット,日替り麺・日替り小丼・サラダ・漬物,"改行のテスト
正しくパースされるといいな",,1,,900,"日替り麺,日本食",';
    $res = Menu::csvParser($csv);
    $expected = array(
      'Restaurant' => array(
        'name' => '橙 daidai',
       ),
      'Menu' => array(
        'name' => '本日の麺セット',
	'description' => '日替り麺・日替り小丼・サラダ・漬物',
	'remarks' => '改行のテスト
正しくパースされるといいな',
	'combo' => false,
	'lunch' => true,
	'dinner' => false,
	'price' => '900',
	'tags' => '日替り麺,日本食',
	'image' => '',
      )
    );
    $this->assertIdentical($res, $expected);
  }

  public function testGetLikelihood() {
    // NG: not an array
    $data = false;
    $res = $this->Menu->getLikelihood($data);
    $this->assertIdentical($res, false);
    // NG: Menu is not an array
    $data = array('Menu' => false);
    $res = $this->Menu->getLikelihood($data);
    $this->assertIdentical($res, false);
    // NG: name does not exist
    $data = array();
    $res = $this->Menu->getLikelihood($data);
    $this->assertIdentical($res, false);
    // NG: restaurant_id is not set
    $data = array(
      'Menu' => array(
        'name' => 'menu2'
      ),
    );
    $res = $this->Menu->getLikelihood($data);
    $this->assertIdentical($res, false);

    // OK: restaurant_id is set
    $data = array(
      'Menu' => array(
        'name' => 'menu2',
        'restaurant_id' => '4'
      ),
    );
    $res = $this->Menu->getLikelihood($data);
    $this->assertIdentical($res['Menu']['name'], $data['Menu']['name']);
    $this->assertIdentical($res['Menu']['restaurant_id'], $data['Menu']['restaurant_id']);

    // empty: name doen't exist in the restaurant_id
    $data = array(
      'Menu' => array(
        'name' => 'menu2',
        'restaurant_id' => '5'
      ),
    );
    $res = $this->Menu->getLikelihood($data);
    $this->assertIdentical($res, array());
  }

  public function testSaveIfNotExist() {
    // NG: restaurant_id doesn't exist
    $data = array(
      'Menu' => array(
        'name' => 'new restaurant',
       ),
    );
    $res = $this->Menu->saveIfNotExist($data);
    $this->assertIdentical($res, false);

    // OK: Data exists and receive the id of it
    $data = array(
      'Menu' => array(
        'name' => 'menu2',
        'restaurant_id' => '4',
       ),
    );
    $res = $this->Menu->saveIfNotExist($data);
    $this->assertIdentical($res, '2');

    // OK: Data does not exist and recieve the inserted id of the new record
    $data = array(
      'Menu' => array(
        'name' => 'new restaurant',
	'restaurant_id' => '8',
       ),
    );
    $res = $this->Menu->saveIfNotExist($data);
    // the result depends on the Fixture. If the biggest number of id on fixture changes, below should be modified.
    $this->assertIdentical($res, '3');
    // check if the tables are saved properly
    $after = $this->Menu->find('first', array('conditions' => Menu::conditionById($res)));
    $this->assertIdentical($after['Menu']['name'], $data['Menu']['name']);
    $this->assertIdentical($after['Menu']['restaurant_id'], $data['Menu']['restaurant_id']);

  }

  public function testSaveThread() {
    // Existing menu
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant4',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.229598',
        'longitude' => '131.547646',
      ),
      'Menu' => array(
        'name' => 'menu2',
	'description' => '日替り麺・日替り小丼・サラダ・漬物',
	'remarks' => '改行のテスト
正しくパースされるといいな',
	'combo' => false,
	'lunch' => true,
	'dinner' => false,
	'price' => '900',
	'tags' => '日替り麺,日本食',
	'image' => '',
      )
    );
    $res = $this->Menu->saveThread($data);
    $this->assertIdentical($res, '2');

    // New menu on existing restaurant
    $data = array(
      'Restaurant' => array(
        'name' => 'restaurant4',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.229598',
        'longitude' => '131.547646',
      ),
      'Menu' => array(
        'name' => 'new menu hoge',
	'description' => '日替り麺・日替り小丼・サラダ・漬物',
	'remarks' => '改行のテスト
正しくパースされるといいな',
	'combo' => false,
	'lunch' => true,
	'dinner' => false,
	'price' => '900',
	'tags' => '日替り麺,日本食',
	'image' => '',
      )
    );
    $res = $this->Menu->saveThread($data);
    $this->assertIdentical($res, '3');

    // New menu on new restaurant
    $data = array(
      'Restaurant' => array(
        'name' => 'new restaurant hoge2',
       ),
      'RestaurantGeo' => array(
        'latitude' => '33.229598',
        'longitude' => '131.547646',
      ),
      'Menu' => array(
        'name' => 'new menu hoge2',
	'description' => '日替り麺・日替り小丼・サラダ・漬物',
	'remarks' => '改行のテスト
正しくパースされるといいな',
	'combo' => false,
	'lunch' => true,
	'dinner' => false,
	'price' => '900',
	'tags' => '日替り麺,日本食',
	'image' => '',
      )
    );
    $res = $this->Menu->saveThread($data);
    $this->assertIdentical($res, '4');
  }

  public function testRoadFromCsv() {
    $res = Menu::roadFromCsv();
    // 雑なチェック
    $this->assertTrue(!!$res);
  }

  public function testInitMenuData() {
    $res = $this->Menu->initMenuData();
    $this->assertTrue($res);
    // TODO: need assert menu and restaurant tables
    $after = $this->Menu->find('all');
    $this->Restaurant = ClassRegistry::init('Restaurant');
    $after_restaurant = $this->Restaurant->find('all');
    pr($after);


  }
}
