<?php
App::uses('AppModel', 'Model');
/**
 * RestaurantGeo Model
 *
 */
class RestaurantGeo extends AppModel {

  public $virtualFields = array(
		'longitude' => 'X(geo)',
		'latitude' => 'Y(geo)',
		);

  public function beforeSave($options = array()) {
    if (!parent::beforeSave($options)) return FALSE;
    $this->data[__CLASS__]['geo'] = self::buildGeo($this->data[__CLASS__]['latitude'], $this->data[__CLASS__]['longitude']);
    return true;
  }

  public static function buildGeo($latitude, $longitude) {
    $db = self::getInstance()->getDataSource();
    return $db->expression("GeomFromText('POINT($longitude $latitude)')");
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
  /* Validations                                                              */
  /****************************************************************************/
  public $validate = array(
	'geo' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			//'message' => 'Your custom message here',
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	),
	'latitude' => array(
		'notEmpty' => array(
		  'rule' => array('notEmpty'),
		  'message' => 'レストランの場所を指定してください',
		),
		'number' => array(
                  'rule' => array('range', -90, 90),
		  'message' => 'レストランの場所を正しく指定してください',
		),
	),
	'longitude' => array(
		'notEmpty' => array(
                  'rule' => array('notEmpty'),
		  'message' => 'レストランの場所を指定してください',
		),
		'number' => array(
                  'rule' => array('range', -180, 180),
		  'message' => 'レストランの場所を正しく指定してください',
		),
	),
  );

  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  public function bindRestaurant($reset = TRUE) {
    App::import('Model', 'Restaurant');
    $bind = array(
      'belongsTo' => array(
        'Restaurant' => array(
          'className'  => 'Restaurant',
          'foreignKey' => 'id',
          'conditions' => array('status' => Restaurant::STATUS_ENABLED),
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  public function bindRestaurantOnKanri($reset = TRUE) {
    $bind = array(
      'belongsTo' => array(
        'Restaurant' => array(
          'className'  => 'Restaurant',
          'foreignKey' => 'id',
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  public function unbindRestaurant($reset = TRUE) {
    $this->unbindModel(array('belongsTo' => array('Restaurant')), $reset);
  }

  /****************************************************************************/
  /* conditions                                                               */
  /****************************************************************************/
  //public static function distanceField() {
  //return __CLASS__.'__distance';
  //}
  // in meter
  public static function setFieldDistanceFrom($latitude, $longitude) {
    // 何度か呼ばれた場合に壊れる事があるので$instanceのinit()が必要
    self::init();
    self::getInstance()->virtualFields['distance'] = "ROUND(GLENGTH( GEOMFROMTEXT( CONCAT( 'LineString( ".$longitude." ".$latitude." , ', X( geo ) ,  ' ', Y( geo ) ,  ')' ) ) ) * 111000 )";
  }

  // conditionInRange と conditionInRange2 は精度が異なる。conditionInRangeはdistanceフィールドが追加される。conditionInRange2は条件のみ。
  public static function conditionInRange($latitude, $longitude, $meter = 500) {
    self::setFieldDistanceFrom($latitude, $longitude);
    return array(__CLASS__.'.distance <' => $meter);
  }
  public static function conditionInRange2($latitude, $longitude, $meter = 500) {
    $latRange = self::latRange($latitude, $meter);
    $lngRange = self::lngRange($longitude, $meter);
    return "MBRContains(GeomFromText('LineString(".$lngRange['east']." ".$latRange['north'].", ".$lngRange['west']." ".$latRange['south'].")'), geo)";
  }

  /****************************************************************************/
  /* calculation                                                              */
  /****************************************************************************/
  public static function degreePerSec() {
    return (1 / (60 * 60));
  }
  public static function latRange($latitude, $range = 500/* m */) {
    // 30.8184の求め方は http://blog.epitaph-t.com/?p=172 参照
    $delta = (($range / 30.8184) * self::degreePerSec());
    // 緯度(500mプラス) ＝ 基準の緯度 + (範囲 ÷ 1秒当たりの緯度 × 1秒当たりの度)
    return array('north' => ($latitude + $delta), 'south' => ($latitude - $delta));
  }
  public static function lngRange($longitude, $range = 500/* m */) {
    // 25.2450の求め方は http://blog.epitaph-t.com/?p=172 参照
    $delta = (($range / 25.2450) * self::degreePerSec());
    // 経度(500mプラス) ＝ 基準の経度 + (範囲 ÷ 1秒当たりの緯度 × 1秒当たりの度)
    return array('east' => ($longitude + $delta), 'west' => ($longitude - $delta));
  }
}
