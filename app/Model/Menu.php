<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 */
class Menu extends AppModel {

  public $actsAs = array('Taggable');


  public $image_upload = TRUE;

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

  public function beforeSave($options = array()) {
    if (!parent::beforeSave($options)) return FALSE;

    if (array_key_exists('tag_id', $this->data[__CLASS__])) {
      $this->data[__CLASS__]['tags'] = $this->tagIdToTags($this->data[__CLASS__]['tag_id']);
    }
    return true;
  }

  public function tagIdToTags($tag_id) {
    $this->loadModel('MenuTag');
    return $this->MenuTag->tagCsv($tag_id);
  }

  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  public function bindRestaurant($reset = TRUE) {
    App::import('Model', 'Restaurant');
    $bind = array(
      'belongsTo' => array(
        'Restaurant' => array(
          'className'  => 'Restaurant',
          'foreignKey' => 'restaurant_id',
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  public function unbindRestaurant($reset = TRUE) {
    $this->unbindModel(array('belongsTo' => array('Restaurant')), $reset);
  }

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
		),
		'restaurant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'combo' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lunch' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'dinner' => array(
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

  /****************************************************************************/
  /* conditions                                                               */
  /****************************************************************************/
  public static function conditionByRestaurantId($restaurant_id) {
    return array(__CLASS__.'.restaurant_id' => $restaurant_id);
  }

  public static function conditionByTags($words, $expansion = false, $isAnd = true) {
    /* if (is_string($words)) $keyword_list = $this->getTagList($words); */
    if (is_string($words)) $keyword_list = explode(',', $words);
    elseif (is_array($words)) $keyword_list = $words;
    else return false;

    $conditions = array();
    // generate a like sentense for each tags
    $tmp = array();
    foreach($keyword_list as $key => $val) {
      $word = addslashes($val);
      $pre = $isAnd ? '+' : '';
      $tmp[] = $pre . '"'.$word.'"';
    }
    $expr = implode(' ', $tmp);

    if ($expansion) {
      $modifier = 'WITH QUERY EXPANSION';
      $min_score = ' >= ' . self::FULLTEXT_MIN_SCORE;
    } else {
      $modifier = 'IN BOOLEAN MODE';
      $min_score = '';
    }
    return "MATCH(Menu.tags) AGAINST('".$expr."' ".$modifier.")".$min_score;
  }
}
