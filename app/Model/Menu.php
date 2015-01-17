<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 */
class Menu extends AppModel {
  public $displayField = 'name';
  public $actsAs = array('Taggable');

  public $image_upload = TRUE;

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
  public $validate = array(
		'id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'name' => array(
			/* 'notEmpty' => array( */
			/* 	'rule' => array('notEmpty'), */
			/* ), */
		),
		'restaurant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'price' => array(
			/* 'notEmpty' => array( */
			/* 	'rule' => array('notEmpty'), */
			/* ), */
		),
		'combo' => array(
			'boolean' => array(
				'rule' => array('boolean'),
			),
		),
		'lunch' => array(
			'boolean' => array(
				'rule' => array('boolean'),
			),
		),
		'dinner' => array(
			'boolean' => array(
				'rule' => array('boolean'),
			),
		),
		'tag_id' => array(
			/* 'notEmpty' => array( */
			/* 	'rule' => array('notEmpty'), */
			/* 	'message' => 'Tagを選択してください', */
			/* ), */
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

  function bindMenuRegistrant($reset = TRUE) {
    $bind = array(
      'hasMany' => array(
        'MenuRegistrant' => array(
          'className'  => 'MenuRegistrant',
          'foreignKey' => 'menu_id',
          'order' => 'created desc',
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  function unbindMenuRegistrant($reset = TRUE) {
    $this->unbindModel(array('hasMany' => array('MenuRegistrant')), $reset);
  }

  function bindMenuImage($reset = TRUE) {
    $bind = array(
      'hasMany' => array(
        'MenuImage' => array(
          'className'  => 'MenuImage',
          'foreignKey' => 'menu_id',
          'order' => 'is_main desc', // is_main is boolean, and it has only a true record in the same menu.
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  function unbindMenuImage($reset = TRUE) {
    $this->unbindModel(array('hasMany' => array('MenuImage')), $reset);
  }

  /****************************************************************************/
  /* Menu Data Initializer                                                    */
  /****************************************************************************/
  public function initMenuData() {
    $datas = self::roadFromCsv();
    foreach($datas as $data) {
      if (!empty($data['Menu']['image'])) {
	$data['Menu']['point'] = 1;
      }
      $saved = $this->saveThread($data);
      if (!$saved) {
	LogTool::error('Failed to save menu from csvfile. $data='.LogTool::formVal($data));
	return false;
      }
    }
    return true;
  }

  // return id or false
  public function saveThread($data) {
    // has to have Restaurant data
    if (!U::arrPrepared(__CLASS__, $data) || !is_array($data[__CLASS__]) || !U::arrPrepared('Restaurant', $data)) return false;
    // Get Restaurant Info.
    $this->loadModel('Restaurant');
    $restaurant_id = $this->Restaurant->saveIfNotExist($data);
    if (!$restaurant_id) {
      $this->invalidate('geo', 'レストランの場所を特定してください。');
      return false;
    }

    // Save Menu
    $data[__CLASS__]['restaurant_id'] = $restaurant_id;
    $this->image_upload = true;
    return $this->saveIfNotExist($data);
  }

  // return id or false
  public function saveForm($data) {
    $form_type = self::checkFormType($data);
    if (!$form_type){
      return false;
    } elseif ($form_type == self::FORM_TYPE_IMAGE){
      return $data[__CLASS__]['id'];
    }
    // has to have Restaurant data
    if (!U::arrPrepared(__CLASS__, $data) || !is_array($data[__CLASS__]) ) return false;
    // formで選択されているとめんどくさいのでidは消しておく。
    unset($data[__CLASS__]['id']);
    $this->image_upload = true;
    return $this->saveIfNotExist($data);
  }

  const FORM_TYPE_IMAGE = 'upload_image';
  const FORM_TYPE_SAVE  = 'new_menu';
  public static function checkFormType($data) {
    if (U::arrPrepared(__CLASS__, $data)) $data = $data[__CLASS__];
    // nameの有無でsaveかを決めた後にidの有無でimageかを決める。
    if (U::arrPrepared('name', $data) && !empty($data['name'])) return self::FORM_TYPE_SAVE;
    if (U::arrPrepared('id', $data) && !empty($data['id'])) return self::FORM_TYPE_IMAGE;
    return false;
  }

  // return id or false
  public function saveIfNotExist($obj) {
    $data = $this->getLikelihood($obj);
    if ($data === false) return false;
    if (!empty($data)) return $data[__CLASS__]['id'];

    $saving = array(__CLASS__ => $obj[__CLASS__]);
    if (array_key_exists('NoModel', $obj)) $saving['NoModel'] = $obj['NoModel'];
    $this->create(); // これが無いと連続で起動した時に別レコードが上書きされてしまう。
    $saved = $this->save($saving);
    if (!$saved) return false;
    return $this->getLastInsertID();
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

  /****************************************************************************/
  /* Get                                                                      */
  /****************************************************************************/
  // 名前と位置情報だけから推察してデータ取得
  public function getLikelihood($data) {
    if (!is_array($data)) return false;
    if (array_key_exists(__CLASS__, $data)) $menu = $data[__CLASS__];
    else $menu = $data;
    if (!U::arrPrepared('name', $menu) || !U::arrPrepared('restaurant_id', $menu)) return false;
    $conditions = self::conditionByName($menu['name']);
    $restaurantCondition = self::conditionByRestaurantId($menu['restaurant_id']);
    $conditions = am($conditions, $restaurantCondition);
    $options = array('conditions' => $conditions);
    return $this->find('first', $options);
  }

  public static function roadFromCsv() {
    // MEMO: 行毎にファイル読み込みすると改行がデータとして存在する場合にまずい。あとで考えよう。
    $path = APP.'Config/data/menu.csv';

    //ファイルを開く
    //モード[r]の読み込み専用
    if (! ($fp = fopen ($path, "r" ))) {
      LogTool::error('Failed to open menu csv file');
      return false;
    }
    //１行ずつファイルを読み込む。
    $arr = array();
    while (! feof ($fp)) {
      $load = fgets ($fp, 4096);
      $arr[] = $load;
    }
    //ファイルを閉じる
    fclose ($fp);

    $ret = array();
    foreach($arr as $key => $csv) {
      $ret[] = self::csvParser($csv);
    }
    return $ret;
  }
  public function listByRestaurant($restaurant_id) {
    $options = array('conditions' => self::conditionByRestaurantId($restaurant_id));
    $options['fields'] = array('name');
    $options['order'] = array('name' => 'ASC');
    return $this->find('list', $options);
  }

  /****************************************************************************/
  /* conditions                                                               */
  /****************************************************************************/
  public static function conditionById($id) {
    return array(__CLASS__.'.id' => $id);
  }
  public static function conditionByName($name) {
    return array(__CLASS__.'.name' => $name);
  }
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
	if (!empty($val)) {
	  if (!array_key_exists('RestaurantGeo', $ret)) $ret['RestaurantGeo'] = array();
	  $ret['RestaurantGeo']['latitude'] = $val;
	}
	break;
      case 2:
	if (!empty($val) && array_key_exists('RestaurantGeo', $ret)) {
	  $ret['RestaurantGeo']['longitude'] = $val;
	}
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
	$ret[__CLASS__]['combo'] = !!$val;
	break;
      case 7:
	$ret[__CLASS__]['lunch'] = !!$val;
	break;
      case 8:
	$ret[__CLASS__]['dinner'] = !!$val;
	break;
      case 9:
	$ret[__CLASS__]['price'] = $val;
	break;
      case 10:
	$ret[__CLASS__]['tags'] = $val;
	break;
      case 11:
	$ret[__CLASS__]['image'] = empty($val) ? NULL : $val;
	break;
      }
    }
    return $ret;
  }
}
