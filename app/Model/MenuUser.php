<?php
App::uses('AppModel', 'Model');
/**
 * MenuUser Model
 *
 * @property Menu $Menu
 * @property User $User
 */
class MenuUser extends AppModel {

  /****************************************************************************/
  /* Validation                                                               */
  /****************************************************************************/
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'menu_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  public function bindMenu($reset = TRUE) {
    $bind = array(
      'belongsTo' => array(
        'Menu' => array(
          'className'  => 'Menu',
          'foreignKey' => 'menu_id',
	  'conditions' => '',
	  'fields' => '',
	  'order' => ''
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  public function unbindMenu($reset = TRUE) {
    $this->unbindModel(array('belongsTo' => array('Menu')), $reset);
  }

  public function bindUser($reset = TRUE) {
    $bind = array(
      'belongsTo' => array(
        'User' => array(
          'className'  => 'User',
          'foreignKey' => 'user_id',
	  'conditions' => '',
	  'fields' => '',
	  'order' => ''
        )
      )
    );
    $this->bindModel($bind, $reset);
  }

  public function unbindUser($reset = TRUE) {
    $this->unbindModel(array('belongsTo' => array('User')), $reset);
  }

  /****************************************************************************/
  /* Save & Edit                                                              */
  /****************************************************************************/
  public function saveNew($menu_id, $user_id) {
    $options = array('conditions' => self::conditionUnique($menu_id, $user_id));
    $current = $this->find('first', $options);
    if (!empty($current)) return true; // It's already on the table

    $saving = self::buildNewData($menu_id, $user_id);
    return $this->save($saving);
  }

  public function deleteUnique($menu_id, $user_id) {
    $options = array('conditions' => self::conditionUnique($menu_id, $user_id));
    $current = $this->find('first', $options);
    if (empty($current)) return true; // It doesn't exist

    $this->id = $current[__CLASS__]['id'];
    return $this->delete();
  }

  /****************************************************************************/
  /* Get                                                                      */
  /****************************************************************************/
  /****************************************************************************/
  /* Conditions                                                               */
  /****************************************************************************/
  public static function conditionUnique($menu_id, $user_id) {
    $condition1 = self::conditionByMenuId($menu_id);
    $condition2 = self::conditionByUserId($user_id);
    return am($condition1, $condition2);
  }
  public static function conditionByMenuId($menu_id) {
    return array(__CLASS__.'.menu_id' => $menu_id);
  }
  public static function conditionByUserId($user_id) {
    return array(__CLASS__.'.user_id' => $user_id);
  }
  /****************************************************************************/
  /* Tools                                                                    */
  /****************************************************************************/
  public static function buildNewData($menu_id, $user_id) {
    return array(__CLASS__ => array('menu_id' => $menu_id, 'user_id' => $user_id));
  }
}
