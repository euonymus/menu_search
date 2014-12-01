<?php
/**
 * Tree behavior class.
 */
App::uses('ModelBehavior', 'Model');
class OpauthBehavior extends ModelBehavior {

/**
 * Initiate Opauth behavior
 *
 * @param Model $Model instance of model
 * @param array $config array of configuration settings.
 *        raw_callback and credentials_callback keys are required, and autoJoinFlg optional
 * @return void
 */
  public function setup(Model $model, $config = array()) {
    $this->raw_callback = $config['raw_callback'];
    $this->credentials_callback = $config['credentials_callback'];

    $this->autoJoinFlg = FALSE;
    if (isset($config['autoJoinFlg'])) {
      $this->autoJoinFlg = $config['autoJoinFlg'];
    }
  }

  /****************************************************************************/
  /* Validation settings                                                      */
  /****************************************************************************/
  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  function bindUser(Model $Model, $reset = TRUE) {
    $bind = array(
      'belongsTo' => array(
        'User' => array(
          'className'  => 'User',
          'foreignKey' => 'user_id',
        )
      )
    );
    $Model->bindModel($bind, $reset);
  }

  /****************************************************************************/
  /* Save / Delete data                                                       */
  /****************************************************************************/
  public function saveOpauth(Model $Model, $auth) {
    $data = $this->formatUser($Model, $auth);
    if (!$data) return FALSE;

    // For member login
    $Model->id = $data[$Model->name]['id'];
    $user_id = $Model->field('user_id');
    if ($user_id) {
      $data = $this->saveUsingUserId($Model, $data, $user_id);
      return $data;
    }

    // For provider which doesn't have email
    if (!isset($auth['info']['email'])) {
      $Model->invalidate('opauth', 'noemail');
      return FALSE;
    }

    // For some provider which has email field
    if ($joined = $this->_autoJoinByEmail($Model, $data, $auth['info']['email'])) {
      return $joined;
    }

    // For registration
    $Model->bindUser(FALSE);
    $data['User'] = $auth['info'];
    $data['User']['username'] = $auth['info']['email'];
    $data['User'] = $Model->User->setPw($data['User']);
    if (!$data['User']) return FALSE;

    $saved = $Model->saveAll($data);
    if (!$saved) return FALSE;

    $data['User']['id'] = $Model->User->getLastInsertID();
    $data['User']['status'] = User::STATUS_ENABLED;
    $data = $this->_unsetForSecurity($data);
    return $data;
  }

  public function createRelation(Model $Model, $username, $auth) {
    $data = $this->formatUser($Model, $auth);
    if (!$data) return FALSE;

    $Model->loadModel('User');
    $user = $Model->User->findByUsername($username);
    if (empty($user)) return FALSE;

    $Model->id = $data[$Model->name]['id'];
    $provider = $Model->read();
    if (!empty($provider) && ($provider[$Model->name]['user_id'] != $user['User']['id'])) {
      $Model->invalidate('opauth', 'used');
      return FALSE;
    }

    $data[$Model->name]['user_id'] = $user['User']['id'];
    return $Model->save($data);
  }

  public function saveUsingUserId(Model $Model, $data, $user_id) {
    $saved = $Model->save($data);
    if (!$saved) return FALSE;

    $Model->loadModel('User');
    $Model->User->id = $user_id;
    $user = $Model->User->read();
    $data['User'] = $user['User'];
    $data = $this->_unsetForSecurity($data);
    return $data;
  }

  function _autoJoinByEmail(Model $Model, $data, $email) {
    if (!$this->autoJoinFlg) return FALSE;

    $Model->loadModel('User');
    if ($relativeUser = $Model->User->findByUsername($email)) {
      $data = $this->saveUsingUser($Model, $data, $relativeUser);
      return $data;
    }
    return FALSE;
  }

  public function saveUsingUser(Model $Model, $data, $user) {
    $data[$Model->name]['user_id'] = $user['User']['id'];
    $saved = $Model->save($data);
    if (!$saved) return FALSE;

    $data['User'] = $user['User'];
    $data = $this->_unsetForSecurity($data);
    return $data;
  }

  /****************************************************************************/
  /* Get data                                                                 */
  /****************************************************************************/
  /****************************************************************************/
  /* Conditions                                                               */
  /****************************************************************************/
  /****************************************************************************/
  /* Tools                                                                    */
  /****************************************************************************/
  public function formatUser(Model $Model, $auth) {
    if (isset($auth['raw'])) {
      $provider = $Model->{$this->raw_callback}($auth['raw']);
    }
    if (isset($auth['credentials'])) {
      $provider = $Model->{$this->credentials_callback}($provider, $auth['credentials']);
    }
    if (empty($provider)) return FALSE;

    $data = array();
    $data[$Model->name] = $provider;
    return $data;
  }

  function _unsetForSecurity($data) {
    unset($data['User']['password']);
    unset($data['User']['email']);
    return $data;
  }

}
