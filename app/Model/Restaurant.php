<?php
App::uses('AppModel', 'Model');
/**
 * Restaurant Model
 *
 */
class Restaurant extends AppModel {
  public $actsAs = array('Master');
  public $displayField = 'name';

  public function beforeValidate($options = array()) {
    if (!parent::beforeValidate($options)) return FALSE;

    if (U::arrPrepared('RestaurantGeo', $this->data)
	&& U::arrPrepared('latitude', $this->data['RestaurantGeo'])
	&& U::arrPrepared('longitude', $this->data['RestaurantGeo'])) {
      $this->bindRestaurantGeo(false);
    }
  }

  /****************************************************************************/
  /* Instance manipulator for static members                                  */
  /****************************************************************************/
  private static $instance = NULL;
  public static function getInstance() {
    if (!self::$instance) {
      // MEMO: DO NOT USE 'new' to Model to avoid using actial database when simpletest
      // self::$instance = new {__CLASS__}();
      self::$instance = ClassRegistry::init(__CLASS__);
    }
    return self::$instance;
  }
  public static function init() {
    self::$instance = NULL;
  }
  protected static function setInstance($instance) {
    self::$instance = $instance;
  }

  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  function bindRestaurantGeo($reset = TRUE) {
    App::import('Model', 'RestaurantGeo');
    $bind = array(
      'hasOne' => array(
        'RestaurantGeo' => array(
          'className'  => 'RestaurantGeo',
          'foreignKey' => 'id',
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  function unbindRestaurantGeo($reset = TRUE) {
    $this->unbindModel(array('hasOne' => array('RestaurantGeo')), $reset);
  }

  public function bindStation($reset = TRUE) {
       $hasAndBelongsToMany = array(
		'Station' => array(
			'className' => 'Station',
			'joinTable' => 'restaurant_stations',
			'foreignKey' => 'restaurant_id',
			'associationForeignKey' => 'station_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
       );
       $this->bindModel(array('hasAndBelongsToMany' => $hasAndBelongsToMany), $reset);
  }

  public function unbindStation($reset = TRUE) {
    $this->unbindModel(array('hasAndBelongsToMany' => array('Station')), $reset);
  }

  function bindMenu($reset = TRUE) {
    $bind = array(
      'hasMany' => array(
        'Menu' => array(
          'className'  => 'Menu',
          'foreignKey' => 'restaurant_id',
          'order' => 'created desc',
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  function unbindMenu($reset = TRUE) {
    $this->unbindModel(array('hasMany' => array('Menu')), $reset);
  }

  function bindRecommendedMenu($reset = TRUE) {
    $bind = array(
      'hasOne' => array(
        'Menu' => array(
          'className'  => 'Menu',
          'foreignKey' => 'restaurant_id',
          'order' => 'Menu.point desc',
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  function unbindRecommendedMenu($reset = TRUE) {
    $this->unbindModel(array('hasOne' => array('Menu')), $reset);
  }

  /****************************************************************************/
  /* Validations                                                              */
  /****************************************************************************/
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
  );

  /****************************************************************************/
  /* Save & Edit                                                              */
  /****************************************************************************/
  // return id or false
  public function saveIfNotExist($obj) {
    $data = $this->getLikelihood($obj);
    if ($data === false) return false;
    if (!empty($data)) return $data[__CLASS__]['id'];

    $saved = $this->saveAll($obj);
    if (!$saved) return false;
    return $this->getLastInsertID();
  }

  /****************************************************************************/
  /* Get                                                                      */
  /****************************************************************************/
  // 名前と位置情報だけから推察してデータ取得
  public function getLikelihood($data) {
    if (!is_array($data)) return false;
    if (array_key_exists(__CLASS__, $data)) $restaurant = $data[__CLASS__];
    else $restaurant = $data;
    if (!U::arrPrepared('name', $restaurant)) return false;
    $conditions = self::conditionByName($restaurant['name']);

    if (array_key_exists('RestaurantGeo', $data)
	&& U::arrPrepared('latitude', $data['RestaurantGeo']) && U::arrPrepared('longitude', $data['RestaurantGeo'])) {
      $geoCondition = self::conditionInRange($data['RestaurantGeo']['latitude'], $data['RestaurantGeo']['longitude'], 30);
      $conditions = am($conditions, $geoCondition);
    }

    $options = array('conditions' => $conditions);
    return $this->find('first', $options);
  }

  /****************************************************************************/
  /* conditions                                                               */
  /****************************************************************************/
  public static function conditionById($id) {
    return array(__CLASS__.'.id' => $id);
  }
  public static function conditionByName($name) {
    // TODO: need to put index on Restaurant.name field
    return array(__CLASS__.'.name' => $name);
  }
  public static function conditionInRange($latitude, $longitude, $meter = 500) {
    // 何度か呼ばれた場合に壊れる事があるので$instanceのinit()が必要
    self::init();
    self::getInstance()->bindRestaurantGeo(FALSE);
    // conditionInRange はうまく動かないのでconditionInRange2を利用、その代わり近い順とかができない。
    return RestaurantGeo::conditionInRange2($latitude, $longitude, $meter);
  }

}
