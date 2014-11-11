<?php
/**
 * WordFixture
 *
 */
class WordFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '???ID???', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'start' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'start_accuracy' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'comment' => 'year, month, day, hour, min, sec', 'charset' => 'utf8'),
		'end_accuracy' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'comment' => 'year, month, day, hour, min, sec', 'charset' => 'utf8'),
		'is_momentary' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0: term, 1: moment'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'name' => array('column' => array('name', 'start', 'end', 'start_accuracy', 'end_accuracy', 'is_momentary'), 'unique' => 0)
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
			'id' => '544cb2ea-0508-413e-8b46-20c2cf13b2c9',
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'start' => '2014-10-26 17:38:02',
			'end' => '2014-10-26 17:38:02',
			'start_accuracy' => 'Lorem ip',
			'end_accuracy' => 'Lorem ip',
			'is_momentary' => 1,
			'created' => '2014-10-26 17:38:02',
			'modified' => '2014-10-26 17:38:02'
		),
	);

}
