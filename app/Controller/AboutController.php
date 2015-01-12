<?php
App::uses('AppController', 'Controller');
class AboutController extends AppController {

  public function index() {
    self::$title_for_layout = 'Coozo（食うぞ）について' . ' - '.self::$title_for_layout;
    self::$description_for_layout = 'Coozoはこれまでに無い次世代型ランチメニュー検索サービスです。町を大きなフードコートに見立てて、レストランではなく食べたい料理から検索して比較検討する事ができます。例えばラーメンを食べたい場合にお店単位ではなく個々のメニューで人気順に各料理の写真を比較しながら選ぶ事ができます。';
  }
}
