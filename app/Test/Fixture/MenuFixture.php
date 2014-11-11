<?php
/**
 * MenuFixture
 *
 */
class MenuFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'restaurant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'remarks' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'combo' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'lunch' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'dinner' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'price' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'tags' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

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
			'remarks' => 'Lorem ipsum dolor sit amet',
			'combo' => 1,
			'lunch' => 1,
			'dinner' => 1,
			'price' => 1,
			'tags' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-11-02 23:35:18',
			'modified' => '2014-11-02 23:35:18'
		),
	);

}
