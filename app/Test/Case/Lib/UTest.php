<?php
App::uses('U', 'Lib');

/**
 * MenuTag Test Case
 *
 */
class UTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenuTag = ClassRegistry::init('MenuTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuTag);

		parent::tearDown();
	}

  function testIsEmpty() {
    // Exceptions
    $needle = null;
    $data = null;
    $this->assertFalse(U::isEmpty($needle, $data));
    $needle = false;
    $data = false;
    $this->assertFalse(U::isEmpty($needle, $data));
    $needle = 'aaa';
    $data = false;
    $this->assertFalse(U::isEmpty($needle, $data));
    $data = true;
    $this->assertFalse(U::isEmpty($needle, $data));
    $data = 'bbb';
    $this->assertFalse(U::isEmpty($needle, $data));
    $data = array();
    $this->assertFalse(U::isEmpty($needle, $data));
    $data = array('aaa');
    $this->assertFalse(U::isEmpty($needle, $data));

    // Not Empties
    $needle = 'aaa';
    $data = array('aaa' => true);
    $this->assertFalse(U::isEmpty($needle, $data));
    $data = array('aaa' => 0);
    $this->assertFalse(U::isEmpty($needle, $data));

    // Empties
    $needle = 'aaa';
    // falseは実際はemptyではないが、empty関数がtrueを返す。また、利用シーンにおいてemptyと扱われる方が汎用性が高い。
    $data = array('aaa' => false);
    $this->assertTrue(U::isEmpty($needle, $data));
    $data = array('aaa' => null);
    $this->assertTrue(U::isEmpty($needle, $data));
    $data = array('aaa' => '');
    $this->assertTrue(U::isEmpty($needle, $data));
    $data = array('aaa' => array());
    $this->assertTrue(U::isEmpty($needle, $data));
  }

  function testNotEmpty() {
    // Exceptions
    $needle = null;
    $data = null;
    $this->assertFalse(U::notEmpty($needle, $data));
    $needle = false;
    $data = false;
    $this->assertFalse(U::notEmpty($needle, $data));
    $needle = 'aaa';
    $data = false;
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = true;
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = 'bbb';
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = array();
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = array('aaa');
    $this->assertFalse(U::notEmpty($needle, $data));

    // Not Empties
    $needle = 'aaa';
    $data = array('aaa' => true);
    $this->assertTrue(U::notEmpty($needle, $data));
    $data = array('aaa' => 0);
    $this->assertTrue(U::notEmpty($needle, $data));

    // Empties
    $needle = 'aaa';
    // falseは実際はemptyではないが、empty関数がtrueを返す。また、利用シーンにおいてemptyと扱われる方が汎用性が高い。
    $data = array('aaa' => false);
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = array('aaa' => null);
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = array('aaa' => '');
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = array('aaa' => array());
    $this->assertFalse(U::notEmpty($needle, $data));
  }
}
