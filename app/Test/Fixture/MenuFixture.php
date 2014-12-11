<?php
/**
 * MenuFixture
 *
 */
class MenuFixture extends CakeTestFixture {
  public $import = 'Menu';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'restaurant_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'image'  => 'http://hogehoge.jpg',
			'remarks' => 'Lorem ipsum dolor sit amet',
			'combo' => 1,
			'lunch' => 1,
			'dinner' => 1,
			'price' => 1,
			'tags' => 'Lorem ipsum dolor sit amet',
			'point' => 0,
			'created' => '2014-11-02 23:35:18',
			'modified' => '2014-11-02 23:35:18'
		),
		array(
			'id' => 2,
			'name' => 'Lorem ipsum dolor sit amet',
			'restaurant_id' => 4,
			'description' => 'Lorem ipsum dolor sit amet',
			'image'  => 'http://hogehoge.jpg',
			'remarks' => 'Lorem ipsum dolor sit amet',
			'combo' => 1,
			'lunch' => 1,
			'dinner' => 1,
			'price' => 1,
			'tags' => 'Lorem ipsum dolor sit amet',
			'point' => 0,
			'created' => '2014-11-02 23:35:18',
			'modified' => '2014-11-02 23:35:18'
		),
	);

}
