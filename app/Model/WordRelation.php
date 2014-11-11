<?php
App::uses('AppModel', 'Model');
/**
 * WordRelation Model
 *
 */
class WordRelation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'start' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_accuracy' => array(
			'maxLength' => array(
				'rule' => array('maxLength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_accuracy' => array(
			'maxLength' => array(
				'rule' => array('maxLength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_momentary' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);


	public static function conditionByWord($word) {
	  return array(__CLASS__.'.name' => $word);
	}
	public static function conditionWithStart($start) {
	  return array(__CLASS__.'.end >=' => $start);
	}
	public static function conditionWithEnd($end) {
	  return array(__CLASS__.'.start <=' => $end);
	}
	public static function conditionWithStartEnd($start, $end) {
	  $condition1 = self::conditionWithStart($start);
	  $condition2 = self::conditionWithEnd($end);
	  return array('and' => $condition1, $condition2);
	}
}
