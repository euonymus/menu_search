<?php
/**
 * TwuserFixture
 *
 */
class TwuserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => true, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'screen_name' => array('type' => 'string', 'null' => false, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_image_url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_image_url_https' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_background_image_url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_background_image_url_https' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_use_background_image' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'profile_text_color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 6, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_link_color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 6, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_background_color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 6, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_sidebar_border_color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 6, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_sidebar_fill_color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 6, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profile_banner_url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'protected' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'is_translator' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'verified' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'contributors_enabled' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'geo_enabled' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'follow_request_sent' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'profile_background_tile' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'location' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'lang' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 5, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'utc_offset' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'time_zone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 15, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'followers_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'friends_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'listed_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'favourites_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'statuses_count' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'default_profile' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'default_profile_image' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'notifications' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'following' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'created_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'secret' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'screen_name' => 'Lorem ipsum d',
			'name' => 'Lorem ipsum dolor ',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'profile_image_url' => 'Lorem ipsum dolor sit amet',
			'profile_image_url_https' => 'Lorem ipsum dolor sit amet',
			'profile_background_image_url' => 'Lorem ipsum dolor sit amet',
			'profile_background_image_url_https' => 'Lorem ipsum dolor sit amet',
			'profile_use_background_image' => 1,
			'profile_text_color' => 'Lore',
			'profile_link_color' => 'Lore',
			'profile_background_color' => 'Lore',
			'profile_sidebar_border_color' => 'Lore',
			'profile_sidebar_fill_color' => 'Lore',
			'url' => 'Lorem ipsum dolor sit amet',
			'profile_banner_url' => 'Lorem ipsum dolor sit amet',
			'protected' => 1,
			'is_translator' => 1,
			'verified' => 1,
			'contributors_enabled' => 1,
			'geo_enabled' => 1,
			'follow_request_sent' => 1,
			'profile_background_tile' => 1,
			'location' => 'Lorem ipsum dolor sit amet',
			'lang' => 'Lor',
			'utc_offset' => 1,
			'time_zone' => 'Lorem ipsum d',
			'followers_count' => 1,
			'friends_count' => 1,
			'listed_count' => 1,
			'favourites_count' => 1,
			'statuses_count' => 1,
			'default_profile' => 1,
			'default_profile_image' => 1,
			'notifications' => 1,
			'following' => 1,
			'created_at' => '2014-12-01 20:27:18',
			'token' => 'Lorem ipsum dolor sit amet',
			'secret' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'created' => '2014-12-01 20:27:18',
			'modified' => '2014-12-01 20:27:18'
		),
	);

}
