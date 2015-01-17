<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {
  public $import = 'User';

/**
 * Records
 *
 * @var array
 */
  public $records = array(
    array(
	'id' => '54abe567-e898-4afe-815b-5a68cf13b2c9',
	'username' => 'coozo.office@gmail.com',
	'password' => '47cd98feb883cd1e9cc2ac3fdd39022f050190df',
	'name' => 'euonymus',
	'nickname' => NULL,
	'first_name' => '',
	'last_name' => '',
	'image' => 'http://coozo.co/apple-touch-icon-precomposed.png',
	'description' => NULL,
	'role' => 'admin',
	'status' => 1,
	'spam' => 0,
	'created' => '2014-12-01 20:26:20',
	'modified' => '2014-12-01 20:26:20'
    ),
    array(
	'id' => '547c505c-62f4-4f24-9b30-4595cf13b2c9',
	'username' => 'Lorem ipsum dolor sit amet',
	'password' => 'Lorem ipsum dolor sit amet',
	'name' => 'Lorem ipsum dolor sit amet',
	'nickname' => 'Lorem ipsum dolor sit amet',
	'first_name' => 'Lorem ipsum dolor sit amet',
	'last_name' => 'Lorem ipsum dolor sit amet',
	'image' => 'Lorem ipsum dolor sit amet',

	'description' => NULL,
	'role' => 'author',
	'status' => 1,
	'spam' => 0,
	'created' => '2014-12-01 20:26:20',
	'modified' => '2014-12-01 20:26:20'
    ),
  );

}
