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
      if (isset($user['thumbnail']) && !empty($user['thumbnail'])) $src = $user['thumbnail'];
      else $src = $user['image'];

      return $this->Html->link($this->Html->image($src, array('height'=>'50pt')),'/mypage',array('escape'=>false));
    }
    return '';
  }

  public function hasFbuser() {
    return !empty($this->_View->viewVars['fbuser']);
  }
  public function hasTwuser() {
    return !empty($this->_View->viewVars['twuser']);
  }
}
