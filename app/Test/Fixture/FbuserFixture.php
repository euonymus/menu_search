<?php
/**
 * FbuserFixture
 *
 */
class FbuserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'username' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'hometown_id' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'unsigned' => true),
		'hometown_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gender' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'timezone' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 3, 'unsigned' => true),
		'locale' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'verified' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'updated_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'token_expires' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 3, 'unsigned' => true),
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
			'id' => '',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'username' => 'Lorem ipsum dolor sit amet',
			'link' => 'Lorem ipsum dolor sit amet',
			'hometown_id' => '',
			'hometown_name' => 'Lorem ipsum dolor sit amet',
			'gender' => 'Lorem ip',
			'email' => 'Lorem ipsum dolor sit amet',
			'timezone' => 1,
			'locale' => 'Lorem ip',
			'verified' => 1,
			'updated_time' => '2014-12-01 20:26:46',
			'token' => 'Lorem ipsum dolor sit amet',
			'token_expires' => '2014-12-01 20:26:46',
			'status' => 1,
			'created' => '2014-12-01 20:26:46',
			'modified' => '2014-12-01 20:26:46'
		),
	);

}
