<?php
App::uses('AppModel', 'Model');
/**
 * MenuTag Model
 *
 */
class MenuTag extends AppModel {

  public $actsAs = array('Master');
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
