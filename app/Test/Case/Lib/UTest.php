<?php
App::uses('U', 'Lib');

class UTest extends CakeTestCase {
  public $fixtures = array(
  );

  public function setUp() {
    parent::setUp();
  }

  public function tearDown() {
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

    // Not Empties
    $needle = 'aaa';
    $data = array('aaa' => true);
    $this->assertFalse(U::isEmpty($needle, $data));
    $data = array('aaa' => 0);
    $this->assertFalse(U::isEmpty($needle, $data));

    // Empties
    $needle = 'aaa';
    $data = array();
    $this->assertTrue(U::isEmpty($needle, $data));
    $data = array('aaa');
    $this->assertTrue(U::isEmpty($needle, $data));
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

  function testNotPrepared() {
    // Exceptions
    $needle = null;
    $data = null;
    $this->assertTrue(U::notPrepared($needle, $data));
    $needle = false;
    $data = false;
    $this->assertTrue(U::notPrepared($needle, $data));
    $needle = 'aaa';
    $data = false;
    $this->assertTrue(U::notPrepared($needle, $data));
    $data = true;
    $this->assertTrue(U::notPrepared($needle, $data));
    $data = 'bbb';
    $this->assertTrue(U::notPrepared($needle, $data));
    $data = array();
    $this->assertTrue(U::notPrepared($needle, $data));
    $data = array('aaa');
    $this->assertTrue(U::notPrepared($needle, $data));

    // Not Empties
    $needle = 'aaa';
    $data = array('aaa' => true);
    $this->assertFalse(U::notPrepared($needle, $data));
    // MEMO: falseの場合、isEmpty, notEmptyとは異なる挙動をする。
    $data = array('aaa' => false);
    $this->assertFalse(U::notPrepared($needle, $data));
    $data = array('aaa' => 0);
    $this->assertFalse(U::notPrepared($needle, $data));

    // Empties
    $needle = 'aaa';
    $data = array('aaa' => null);
    $this->assertTrue(U::notPrepared($needle, $data));
    $data = array('aaa' => '');
    $this->assertTrue(U::notPrepared($needle, $data));
    $data = array('aaa' => array());
    $this->assertTrue(U::notPrepared($needle, $data));
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

    // Not Empties
    $needle = 'aaa';
    $data = array('aaa' => true);
    $this->assertTrue(U::notEmpty($needle, $data));
    $data = array('aaa' => 0);
    $this->assertTrue(U::notEmpty($needle, $data));

    // Empties
    $needle = 'aaa';
    $data = array();
    $this->assertFalse(U::notEmpty($needle, $data));
    $data = array('aaa');
    $this->assertFalse(U::notEmpty($needle, $data));
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
