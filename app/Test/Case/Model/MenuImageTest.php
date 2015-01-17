<?php
App::uses('MenuImage', 'Model');

/**
 * MenuImage Test Case
 *
 */
class MenuImageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menu_image',
		'app.menu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MenuImage = ClassRegistry::init('MenuImage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MenuImage);

		parent::tearDown();
	}

}
