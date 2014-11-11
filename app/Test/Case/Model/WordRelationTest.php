<?php
App::uses('WordRelation', 'Model');

/**
 * WordRelation Test Case
 *
 */
class WordRelationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.word_relation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WordRelation = ClassRegistry::init('WordRelation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WordRelation);

		parent::tearDown();
	}

}
