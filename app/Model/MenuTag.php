<?php
App::uses('AppModel', 'Model');
/**
 * MenuTag Model
 *
 */
class MenuTag extends AppModel {

  //public $actsAs = array('Master');
  const STATUS_DISABLED = 0;
  const STATUS_ENABLED  = 1;
  static $statusList = array(
    self::STATUS_DISABLED => '無効',
    self::STATUS_ENABLED => '有効',
  );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'menu' => array(
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
  /* Find Data                                                                */
  /****************************************************************************/
  public function tagCsv($id) {
    return self::buildCsv($this->findById($id));
  }

  public function getList() {
    $options = array('conditions' => self::conditionByActive());
    $options['order'] = array(__CLASS__.'.order' => 'ASC');
    return $this->find('list', $options);
  }

  /****************************************************************************/
  /* Conditions                                                               */
  /****************************************************************************/
  public static function conditionByActive() {
    return array(__CLASS__.'.status' => self::STATUS_ENABLED);
  }

  /****************************************************************************/
  /* Parse Data                                                               */
  /****************************************************************************/
  public static function buildCsv($data) {
    if (array_key_exists(__CLASS__, $data)) $data = $data[__CLASS__];

    $list = array($data['name']);
    if (U::notEmpty('accessories', $data)) {
      $accessories = explode(',',$data['accessories']);
      $list = am($list, $accessories);
    }
    return implode(',', $list);
  }
}
