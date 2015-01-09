<?php
App::uses('AppController', 'Controller');
class PrivacyController extends AppController {

  public function index() {
    self::$title_for_layout = 'プライバシーポリシー' . ' - '.self::$title_for_layout;
  }
}
