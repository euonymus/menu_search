<?php
App::uses('AppModel', 'Model');
/**
 * MenuRegistrant Model
 *
 * @property Menu $Menu
 * @property User $User
 */
class MenuRegistrant extends AppModel {

  /****************************************************************************/
  /* Validation                                                               */
  /****************************************************************************/
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

  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  public $belongsTo = array(
	'Menu' => array(
		'className' => 'Menu',
		'foreignKey' => 'menu_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	),
	'User' => array(
		'className' => 'User',
		'foreignKey' => 'user_id',
		'conditions' => '',
		'fields' => '',
		'order' => ''
	)
  );

  /****************************************************************************/
  /* Save & Edit                                                              */
  /****************************************************************************/
  public function saveRelation($menu_id, $user_id) {
    $data = array(__CLASS__ => array(
      'menu_id' => $menu_id,
      'user_id' => $user_id,
    ));
    return $this->save($data);
  }

  /****************************************************************************/
  /* Get                                                                      */
  /****************************************************************************/
  public function getRelation($menu_id, $user_id) {
    return $this->find('first', array('conditions' => self::conditionRelation($menu_id, $user_id)));
  }

  /****************************************************************************/
  /* conditions                                                               */
  /****************************************************************************/
  public static function conditionRelation($menu_id, $user_id) {
    return am(self::conditionByMenuId($menu_id), self::conditionByUserId($user_id));
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
}
