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
}
