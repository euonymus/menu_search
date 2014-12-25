<?php
class UserHelper extends AppHelper {
  public $helpers = array('Html', 'Form');

  static $conductor = false;

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function mypageLink() {
    if ($user = $this->_View->Session->read('Auth.User')){
      return $this->Html->link($this->Html->image($user['image'], array('height'=>'100%')),'/mypage',array('escape'=>false));
    }
    return '';
  }
}
