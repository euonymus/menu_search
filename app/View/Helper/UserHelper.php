<?php
class UserHelper extends AppHelper {
  public $helpers = array('Html', 'Form');

  static $conductor = false;

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function loggedIn() {
    return !!$this->_View->Session->read('Auth.User');
  }

  public function mypageLink() {
    if ($user = $this->_View->Session->read('Auth.User')){
      $src = $user['image'];
      if (U::isLocalPath($src) && isset($user['thumbnail']) && !empty($user['thumbnail'])) $src = $user['thumbnail'];
      return $this->Html->link($this->Html->image($src),'/mypage',array('escape'=>false));
    }
    return '';
  }

  public function hasFbuser() {
    return !empty($this->_View->viewVars['fbuser']);
  }
  public function hasTwuser() {
    return !empty($this->_View->viewVars['twuser']);
  }
  public static function fbImagePath($fbuser_id) {
    return 'https://graph.facebook.com/'.$fbuser_id.'/picture?type=square';
  }

  public static function showName($data) {
    if (!U::arrPrepared('first_name', $data) || empty($data['first_name'])
	|| !U::arrPrepared('last_name', $data) || empty($data['last_name'])
	) {
      if (U::arrPrepared('name', $data) || !empty($data['name'])) {
	return $data['name'];
      }
      return '';
    }
    return $data['first_name'] . ' ' . $data['last_name'];
  }

}
