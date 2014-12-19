<?php
App::uses('Menu', 'Model');

/**
 * Menu Test Case
 *
 */
class MenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
           'app.menu',
	   'app.menu_user',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Menu = ClassRegistry::init('Menu');
	}

/**
 * tearDown method
 *
 * @return void
 */
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
	'combo' => '',
	'lunch' => '1',
	'dinner' => '',
	'price' => '900',
	'tags' => '日替り麺,日本食',
	'image' => '',
      )
    );
    $this->assertIdentical($res, $expected);
  }

/*   public function testSaveCsv() { */
/*     $data = array( */
/*       'Restaurant' => array( */
/*         'name' => '橙 daidai', */
/*        ), */
/*       'RestaurantGeo' => array( */
/*         'latitude' => '35.64594541953124', */
/* 	'longitude' => '139.7080492973328', */
/*       ), */
/*       'Menu' => array( */
/*         'name' => '本日の麺セット', */
/* 	'description' => '日替り麺・日替り小丼・サラダ・漬物', */
/* 	'remarks' => '改行のテスト */
/* 正しくパースされるといいな', */
/* 	'combo' => '', */
/* 	'lunch' => '1', */
/* 	'dinner' => '', */
/* 	'price' => '900', */
/* 	'tags' => '日替り麺,日本食', */
/* 	'image' => '', */
/*       ) */
/*     ); */
/*     $data = Menu::csvParser($csv); */

/*   } */
}
