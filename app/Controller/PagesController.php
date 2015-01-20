<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
  public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
  public function display() {
    $this->helpers[] = 'Menu';
    $this->_loadComponent('MenuTool');
    // ややこしいセッションは全部消しておく。
    $this->MenuTool->sessionInit();
    // next page を categories として上書きする。
    $this->Session->write(MenuToolComponent::SESSION_NEXT_PAGE, 'categories');
    $this->loadModel('Station');
    $this->set('stations', $this->Station->find('list'));
  }

  public function ebisu() {
    $this->_station(1, '恵比寿');
  }
  public function nakameguro() {
    $this->_station(2, '中目黒');
  }
  public function daikanyama() {
    $this->_station(3, '代官山');
  }
  public function ikejiriohashi() {
    $this->_station(4, '池尻大橋');
  }
  public function _station($station_id, $station) {
    $this->_loadComponent('MenuTool');
    // ややこしいセッションは全部消しておく。
    $this->MenuTool->sessionInit();
    // 駅情報をsessionにセットしておく。
    $this->Session->write(MenuToolComponent::SESSION_STATION, $station_id);
    // SEO
    self::$title_for_layout = $station.'のランチ検索 - '.self::$title_for_layout;
    self::$description_for_layout = $station.'エリアに特化したランチ検索サービス。ランチメニューを種類毎に比較！一番好みの食べたい料理を見つけてお店へGo！';
    $this->set(compact('station'));
    $this->render('station');
  }

}
