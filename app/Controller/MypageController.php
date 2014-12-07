<?php
App::uses('AppController', 'Controller');
/**
 * Mypage Controller
 *
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MypageController extends AppController {
  public $components = array('Paginator', 'Session', 'RequestHandler');

  const FULLTEXT_MIN_SCORE = 50;

  public function index() {
  }
}
