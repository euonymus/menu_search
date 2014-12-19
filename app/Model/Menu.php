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
  /* Validation                                                               */
  /****************************************************************************/
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
  /* Model bind settings                                                      */
  /****************************************************************************/
  public function bindRestaurant($reset = TRUE) {
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

  function bindMenuUser($reset = TRUE) {
    $bind = array(
      'hasMany' => array(
        'MenuUser' => array(
          'className'  => 'MenuUser',
          'foreignKey' => 'menu_id',
          'order' => 'created desc',
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  function unbindMenuUser($reset = TRUE) {
    $this->unbindModel(array('hasMany' => array('MenuUser')), $reset);
  }

  /****************************************************************************/
  /* Save & Edit                                                              */
  /****************************************************************************/
  public function updatePoint($id) {
    $data = $this->findById($id, array('id', 'point'));
    // calculate point
    $this->loadModel('MenuUser');
    $data[__CLASS__]['point'] = $this->MenuUser->sumUpLikes($id);
    return $this->save($data);
  }

  public function saveCsv($csv) {
    $data = self::csvParser($csv);
    return $this->saveThread($data);
  }

  public function saveThread($data) {
    // TODO: treat restaurant part
    if (array_key_exists('Restaurant', $data)) {
      $restaurant = $this->Restaurant->getLikelihood($data);
    }


    // TODO: treat menu part

  }

  /****************************************************************************/
  /* Get                                                                      */
  /****************************************************************************/
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
    return array("MATCH(Menu.tags) AGAINST('".$expr."' ".$modifier.")".$min_score);
  }

  /****************************************************************************/
  /* Tools                                                                    */
  /****************************************************************************/
  public static function csvParser($csv) {
    $arr = str_getcsv($csv);
    $ret = array();
    foreach($arr as $key => $val) {
      switch ($key) {
      case 0:
	if (!array_key_exists('Restaurant', $ret)) $ret['Restaurant'] = array();
	$ret['Restaurant']['name'] = $val;
	break;
      case 1:
	if (!array_key_exists('RestaurantGeo', $ret)) $ret['RestaurantGeo'] = array();
	$ret['RestaurantGeo']['latitude'] = $val;
	break;
      case 2:
	$ret['RestaurantGeo']['longitude'] = $val;
	break;
      case 3:
	if (!array_key_exists(__CLASS__, $ret)) $ret[__CLASS__] = array();
	$ret[__CLASS__]['name'] = $val;
	break;
      case 4:
	$ret[__CLASS__]['description'] = $val;
	break;
      case 5:
	$ret[__CLASS__]['remarks'] = $val;
	break;
      case 6:
	$ret[__CLASS__]['combo'] = $val;
	break;
      case 7:
	$ret[__CLASS__]['lunch'] = $val;
	break;
      case 8:
	$ret[__CLASS__]['dinner'] = $val;
	break;
      case 9:
	$ret[__CLASS__]['price'] = $val;
	break;
      case 10:
	$ret[__CLASS__]['tags'] = $val;
	break;
      case 11:
	$ret[__CLASS__]['image'] = $val;
	break;
      }
    }
    return $ret;
  }
}
