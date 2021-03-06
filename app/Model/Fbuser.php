<?php
App::uses('AppModel', 'Model');
/**
 * Fbuser Model
 *
 */
class Fbuser extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
  public $name = 'Fbuser';
  public $actsAs = array('Opauth' => array(
					   'raw_callback' => 'format_raw',
					   'credentials_callback' => 'format_credentials',
					   'autoJoinFlg' => true
					   ));

  /****************************************************************************/
  /* Required by OpauthBehavior                                               */
  /****************************************************************************/
  public function format_raw($raw) {
    $data = $raw;
    if (array_key_exists('hometown_id', $raw)) {
      $data['hometown_id'] = $raw['hometown']['id'];
      $data['hometown_name'] = $raw['hometown']['name'];
    }
    return $data;
  }

  public function format_credentials($data, $credentials) {
    $data['token'] = $credentials['token'];
    $data['token_expires'] = date('Y-m-d H:i:s', strtotime($credentials['expires']));
    return $data;
  }
  /****************************************************************************/
  /* Validation settings                                                      */
  /****************************************************************************/
  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  /****************************************************************************/
  /* Save / Delete data                                                       */
  /****************************************************************************/
  /****************************************************************************/
  /* Get data                                                                 */
  /****************************************************************************/
  /****************************************************************************/
  /* Conditions                                                               */
  /****************************************************************************/
  /****************************************************************************/
  /* Tools                                                                    */
  /****************************************************************************/
}
