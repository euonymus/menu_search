<?php
/**
 * RestaurantStationFixture
 *
 */
class RestaurantStationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'restaurant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'station_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'restaurant_id' => 1,
			'station_id' => 1,
			'modified' => '2014-11-23 18:33:03',
			'created' => '2014-11-23 18:33:03'
		),
	);

}
