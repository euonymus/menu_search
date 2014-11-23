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
}
