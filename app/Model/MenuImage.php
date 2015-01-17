<?php
App::uses('AppModel', 'Model');
/**
 * MenuImage Model
 *
 * @property Menu $Menu
 */
class MenuImage extends AppModel {
  public $image_upload = TRUE;

  /****************************************************************************/
  /* Validation                                                               */
  /****************************************************************************/
  public $validate = array(
	'menu_id' => array(
		'numeric' => array(
			'rule' => array('numeric'),
		),
	),
	'image' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
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
	)
  );

  /****************************************************************************/
  /* Save & Edit                                                              */
  /****************************************************************************/
  public function saveRelation($imageData, $menu_id, $user_id) {
    $data = array(
      __CLASS__ => array(
          'menu_id' => $menu_id,
          'user_id' => $user_id,
      ),
      'NoModel' => $imageData,
    );
    return $this->save($data);
  }

  /****************************************************************************/
  /* Get                                                                      */
  /****************************************************************************/
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
