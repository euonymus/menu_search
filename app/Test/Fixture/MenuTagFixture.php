<?php
/**
 * MenuTagFixture
 *
 */
class MenuTagFixture extends CakeTestFixture {
  public $import = 'MenuTag';

  public $records = array(
	array(
		'id' => 1,
		'name' => 'カレー',
		'accessories' => '',
		'order' => 1,
		'status' => 1,
		'created' => '2014-11-03 10:38:47',
		'modified' => '2014-11-03 10:38:47'
	),
	array(
		'id' => 2,
		'name' => 'カレーライス',
		'accessories' => 'カレー,日本食',
		'order' => 999999999,
		'status' => 0,
		'created' => '2014-11-03 10:38:47',
		'modified' => '2014-11-03 10:38:47'
	),
  );

}
