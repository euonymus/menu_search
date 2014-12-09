<?php
App::uses('AppController', 'Controller');
/**
 * Mypage Controller
 *
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MypageController extends AppController {
  public $components = array('Paginator', 'Session');

  function beforeFilter() {
    parent::beforeFilter();
    //ログインが必要なアクション
    $this->Auth->deny();
  }

  public function index() {
  }
}
