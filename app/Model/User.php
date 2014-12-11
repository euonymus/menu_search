<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
  public $name = 'User';

  public $image_upload = TRUE;

  const STATUS_DISABLED = 0;
  const STATUS_ENABLED  = 1;

  const PROVIDER_TWITTER  = 'Twitter';
  const PROVIDER_FACEBOOK = 'Facebook';

  static $providers = array(
			    self::PROVIDER_TWITTER => 'Twuser',
			    self::PROVIDER_FACEBOOK => 'Fbuser',
			    );

  public function beforeSave($options = array()) {
    if (!parent::beforeSave($options)) return FALSE;

    if (isset($this->data[$this->alias]['password'])) {
      $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return TRUE;
  }

  /****************************************************************************/
  /* Validation settings                                                      */
  /****************************************************************************/
  public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
		'message' => 'メールアドレスを入力してください。',
	    ),
            'valid' => array(
                'rule' => array('email'),
		'message' => '有効なメールアドレスを入力してください。',
	    ),
            'isUnique' => array(
                'rule' => array('isUnique'),
		'message' => 'このメールアドレスは既に登録されています。',
	    ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
		'message' => 'パスワードを入力してください。',
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                /* 'message' => 'Please enter a valid role', */
                'allowEmpty' => FALSE
            )
        )
  );

  /****************************************************************************/
  /* Model bind settings                                                      */
  /****************************************************************************/
  public function bindAllChild($reset = TRUE) {
    foreach(self::$providers as $provider) {
      $this->bindChild($provider, $reset);
    }
  }

  public function bindChild($Child, $reset = TRUE) {
    if (!in_array($Child, self::$providers)) return FALSE;
    $bind = array(
	  'hasMany' => array(
	     $Child => array(
	       'className'  => $Child,
	       'foreignKey' => 'user_id',
	       'dependent' => true, // for the cascaded delete
	       'exclusive' => true,
	       )
	     )
	  );
    $this->bindModel($bind, $reset);
  }

  /****************************************************************************/
  /* Save / Delete data                                                       */
  /****************************************************************************/
  public function setEmail($user, $form) {
    $user = $this->setAuth($user, $form);

    foreach($user as $key => $val) {
      if ($key == __CLASS__) $this->data[$key] = $val;
      else {
	$this->data[$key][0] = $val;
	$this->bindChild($key, FALSE);
      }
    }
    return $this->saveAll();
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
  public function getChildModel($provider) {
    return isset(self::$providers[$provider]) ? self::$providers[$provider] : FALSE;
  }

  public function setPw($data) {
    if (!isset($data['username'])) return FALSE;
    $data['password'] = $this->_generateDefaultPassword($data['username']);
    return $data;
  }

  public function setAuth($user, $form) {
    $form[__CLASS__] = $this->setPw($form[__CLASS__]);
    $user[__CLASS__] = am($user[__CLASS__], $form[__CLASS__]);
    return $user;
  }

  private function _generateDefaultPassword($username) {
    return sha1(md5(sha1($username)));
  }

}