<?php
App::uses('AppModel', 'Model');
/**
 * Word Model
 *
 * @property Word $Related
 */
class Word extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
                                'rule' => array('maxLength', 255),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'maxLength' => array(
                                'rule' => array('maxLength', 255),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_accuracy' => array(
			'maxLength' => array(
                                'rule' => array('maxLength', 10),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_accuracy' => array(
			'maxLength' => array(
                                'rule' => array('maxLength', 10),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Related' => array(
			'className' => 'Word',
			'joinTable' => 'word_relations',
			'foreignKey' => 'word_id',
			'associationForeignKey' => 'related_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);


	const SEARCH_TYPE_ALL         = 1;
	const SEARCH_TYPE_STARTCAP    = 2;
	const SEARCH_TYPE_ENDCAP      = 3;
	const SEARCH_TYPE_STARTENDCAP = 4;

	const DATE_ORIGIN  = '0000-00-00';  // Start date is not decided
	const DATE_ETERNAL = '9999-12-31';  // End date is not decided
	public function findByWordAtPeriod($word, $pointTime) {
	  $searchPeriod = self::searchPeriodFromPointTime($pointTime);
	  if (!$searchPeriod) return array();

	  App::uses('WordRelation', 'Model');
	  $periodCondition = self::conditionWithStartEnd($searchPeriod['start'], $searchPeriod['end']);
	  $relatedCondition = WordRelation::conditionWithStartEnd($searchPeriod['start'], $searchPeriod['end']);

	  $conditions = self::conditionByWord($word);
	  $conditions = am($conditions, $periodCondition);
	  $this->hasAndBelongsToMany['Related']['conditions'] = $relatedCondition;
	  $options = array('conditions' => $conditions);
	  return $this->find('first', $options);
	}

	const POINT_PERIOD_YEAR   = 'year';
	const POINT_PERIOD_MONTH  = 'month';
	const POINT_PERIOD_DAY    = 'day';
	public static function searchPeriodFromPointTime($pointTime) {
	  $pointTimeType = self::detectPointTimeType($pointTime);
	  if (!$pointTimeType) return false;

	  $pointTime = str_replace('-','',$pointTime);
	  $year = substr($pointTime,0, 4);
	  if ($pointTimeType == self::POINT_PERIOD_YEAR) {
	    $start = $year . '-01-01';
	    $end   = $year . '-12-31';
	  } elseif ($pointTimeType == self::POINT_PERIOD_MONTH) {
	    $month = substr($pointTime,4, 2);
	    $lastDay = U::lastDayInMonth($month, $year);

	    $start = date('Y-m-01', strtotime($year));
	    $end   = date('Y-m-'.$lastDay, strtotime($year));
	  } elseif ($pointTimeType == self::POINT_PERIOD_DAY) {
	    $start = date('Y-m-d 00:00:00', strtotime($pointTime));
	    $end   = date('Y-m-d 23:59:59', strtotime($pointTime));
	  } else return false;
	  return compact('start','end');
	}
	public static function detectPointTimeType($pointTime) {
	  if (preg_match('/^\d{4}$/', $pointTime)) return self::POINT_PERIOD_YEAR;
	  if (preg_match('/^(\d{4})-?(0[1-9]|1[0-2])$/', $pointTime)) return self::POINT_PERIOD_MONTH;
	  if (preg_match('/^(\d{4})-?(0[1-9]|1[0-2])-?(0[1-9]|[12][0-9]|3[01])$/', $pointTime)) return self::POINT_PERIOD_DAY;
	  return false;
	}



	public function findByWordInPeriod($word, $start, $end) {
	  $searchPattern = self::detectSearchPattern($start, $end);
	  if (!$searchPattern) return false;

	  App::uses('WordRelation', 'Model');
	  if ($searchPattern == self::SEARCH_TYPE_STARTCAP) {
	    $periodCondition = self::conditionWithStart($start);
	    $relatedCondition = WordRelation::conditionWithStart($start);
	  } elseif ($searchPattern == self::SEARCH_TYPE_ENDCAP) {
	    $periodCondition = self::conditionWithEnd($end);
	    $relatedCondition = WordRelation::conditionWithEnd($end);
	  } elseif ($searchPattern == self::SEARCH_TYPE_STARTENDCAP) {
	    $periodCondition = self::conditionWithStartEnd($start, $end);
	    $relatedCondition = WordRelation::conditionWithStartEnd($start, $end);
	  }
	  $conditions = self::conditionByWord($word);
	  if (isset($periodCondition)) {
	    $conditions = am($conditions, $periodCondition);
	    $this->hasAndBelongsToMany['Related']['conditions'] = $relatedCondition;
	  }
	  $options = array('conditions' => $conditions);
	  return $this->find('first', $options);
	}

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

	public static function detectSearchPattern($start, $end) {
	  $noStart = is_null($start);
	  $noEnd = is_null($end);

	  if ($noEnd) {
	    if ($noStart) return self::SEARCH_TYPE_ALL;
	    else return self::SEARCH_TYPE_STARTCAP;
	  } else {
	    if ($noStart) return self::SEARCH_TYPE_ENDCAP;
	  }
	  if ($start > $end) return false;
	  return self::SEARCH_TYPE_STARTENDCAP;
	}
}
