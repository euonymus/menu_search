<?php
App::uses('MenuRegistrant', 'Model');

class MenuRegistrantTest extends CakeTestCase {
  public $fixtures = array(
	'app.menu_registrant',
	'app.menu',
	'app.user'
  );

  public function setUp() {
    parent::setUp();
    $this->MenuRegistrant = ClassRegistry::init('MenuRegistrant');
  }

  public function tearDown() {
    unset($this->MenuRegistrant);
    parent::tearDown();
  }

  public function testGetRelation() {
    // NG
    $menu_id = NULL;
    $user_id = NULL;

    $res = $this->MenuRegistrant->getRelation($menu_id, $user_id);
    $this->assertIdentical($res, array());
    // NG
    $menu_id = 1;
    $user_id = NULL;
    $res = $this->MenuRegistrant->getRelation($menu_id, $user_id);
    $this->assertIdentical($res, array());
    // NG: convination does not exist
    $menu_id = 2;
    $user_id = '54abe567-e898-4afe-815b-5a68cf13b2c9';
    $res = $this->MenuRegistrant->getRelation($menu_id, $user_id);
    $this->assertIdentical($res, array());

    // OK
    $menu_id = 1;
    $user_id = '54abe567-e898-4afe-815b-5a68cf13b2c9';
    $res = $this->MenuRegistrant->getRelation($menu_id, $user_id);
    $this->assertTrue(U::arrPrepared('MenuRegistrant', $res));
    $this->assertTrue(U::arrPrepared('Menu', $res));
    $this->assertTrue(U::arrPrepared('User', $res));
  }

  public function testSaveRelation() {
    $menu_id = 2;
    $user_id = '547c505c-62f4-4f24-9b30-4595cf13b2c9';
    $res = $this->MenuRegistrant->saveRelation($menu_id, $user_id);
    $this->assertTrue(!!$res);
  }
}
