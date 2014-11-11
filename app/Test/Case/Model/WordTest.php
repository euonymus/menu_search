<?php
App::uses('Word', 'Model');

/**
 * Word Test Case
 *
 */
class WordTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.word',
		'app.word_relation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Word = ClassRegistry::init('Word');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Word);

		parent::tearDown();
	}

}
