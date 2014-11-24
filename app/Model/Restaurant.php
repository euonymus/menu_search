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
