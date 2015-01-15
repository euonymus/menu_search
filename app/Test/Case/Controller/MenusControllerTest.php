<?php
App::uses('MenusController', 'Controller');

/**
 * MenusController Test Case
 *
 */
class MenusControllerTest extends ControllerTestCase {

  public $fixtures = array(
    'app.menu',
    'app.restaurant',
    'app.restaurant_geo',
    'app.menu_tag',
    'app.menu_registrant'
  );

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

  public function testAdd_restaurant() {
    $action = '/menus/add_restaurant';
    $now = time() * 1000;
    $Menus = $this->generate('Menus', array('components' => array('Session')));
    $Menus->Session->expects($this->any())->method('read')->will($this->returnValueMap([['current_location',
      array(
	    'timestamp' => $now,
	    'coords' => array(
			      'speed' => NULL,
			      'heading' => NULL,
			      'altitudeAccuracy' => NULL,
			      'accuracy' => 20,
			      'altitude' => NULL,
			      'longitude' => 131.557546,
			      'latitude' => 33.239498,
			      ),
    )]]));

    // GET test ====================================================================
    // No inputs
    $result = $this->testAction($action, array('method'=>'get','return'=>'contents'));
    //pr($result);
    debug($this->view);
    //debug($this->contents);
    //pr($this->vars);
    $this->assertTrue(is_array($this->vars['restaurantList']));

    // POST test ====================================================================
  }

  public function testAdd() {
    $action = '/menus/add';

    // GET test ====================================================================
    // No inputs
    $result = $this->testAction($action, array('method'=>'get','return'=>'contents'));
    //debug($this->view);
    //debug($this->contents);
    //pr($this->vars);
    $this->assertTrue(is_array($this->vars['menuTagList']));
    $this->assertTrue(is_array($this->vars['restaurantList']));

    // POST test ====================================================================
    // Post adding data as Fund
    /* $data = array( */
    /*   'NoModel' => array( */
    /*     'thumb' => NULL, */
    /* 	'horizontal' => FALSE, */
    /* 	'image_file' => array( */
    /* 			      'name' => NULL, */
    /* 			      'type' => NULL, */
    /* 			      'tmp_name' => NULL, */
    /* 			      'error' => 4, */
    /* 			      'size' => 0 */
    /* 			      ), */
    /*   ), */
    /*   'Menu' => array( */
    /*     'name'   => 'ほげほげのムニエル', */
    /* 	'price'  => '500', */
    /* 	'tag_id' => 2, */
    /*   ), */
    /*   'Restaurant' => array( */
    /*     'name' => 'ほかほか亭' */
    /*   ), */
    /*   'RestaurantGeo' => array( */
    /*     'latitude' => '35.646', */
    /*     'longitude' => '139.703', */
    /*   ), */
    /*   'MenuRegistrant' => array( */
    /*     'user_id' => '547c505c-62f4-4f24-9b30-4595cf13b2c9', */
    /*   ), */
    /* ); */
    /* $options = array('method'=>'post', 'data' => $data); */
    /* $result = $this->testAction($action, $options); */
    /* // Check the saved data in Investment. */
    /* $this->Menu = ClassRegistry::init('Menu'); */
    /* // MEMO: nameである必要は無いがID以外で一意に特定するために使っている。 */
    /* $savedData = $this->Menu->findByName($data['Menu']['name']); */

    /* $this->assertIdentical($data['Menu']['name'], $savedData['Menu']['name']); */
    /* $this->assertIdentical($savedData['Company']['is_domestic'], true); */
    /* $this->assertIdentical($data['User']['User'], $savedData['User'][0]['id']); */
  }

  public function testIndex() {
    $this->markTestIncomplete('testIndex not implemented.');
  }

  public function testView() {
    $this->markTestIncomplete('testView not implemented.');
  }

  public function testEdit() {
    $this->markTestIncomplete('testEdit not implemented.');
  }

  public function testDelete() {
    $this->markTestIncomplete('testDelete not implemented.');
  }

}
