<?php
App::uses('AppController', 'Controller');
class TermsController extends AppController {

  public function index() {
    self::$title_for_layout = '利用規約' . ' - '.self::$title_for_layout;
  }
}
