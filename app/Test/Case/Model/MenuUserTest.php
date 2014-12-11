<?php
App::uses('MenuUser', 'Model');

/**
 * MenuUser Test Case
 *
 */
class MenuUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu_user',
		'app.menu',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenuUser = ClassRegistry::init('MenuUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuUser);

		parent::tearDown();
	}

  public function testSumUpLikes() {
    $menuId = 2;
    $res = $this->MenuUser->sumUpLikes($menuId);
    $this->assertIdentical($res, 3);
  }
}
