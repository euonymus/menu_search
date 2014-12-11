<?php
App::uses('AppModel', 'Model');
/**
 * Restaurant Model
 *
 */
class Restaurant extends AppModel {

  public $actsAs = array('Master');
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
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
	);

  /****************************************************************************/
  /* conditions                                                               */
  /****************************************************************************/
  public static function conditionById($id) {
    return array(__CLASS__.'.id' => $id);
  }

}
