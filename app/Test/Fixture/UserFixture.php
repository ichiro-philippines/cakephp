<?php
/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'unsigned' => false, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 220, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 14, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'full_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 220, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'role' => array('type' => 'tinyinteger', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modifed' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum ',
			'full_name' => 'Lorem ipsum dolor sit amet',
			'role' => 1,
			'created' => '2022-09-27 10:41:05',
			'modifed' => '2022-09-27 10:41:05'
		),
	);

}
