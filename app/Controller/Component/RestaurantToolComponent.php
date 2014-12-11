<?php
App::uses('Component', 'Controller');
class RestaurantToolComponent extends Component {
  public $components = array('ParamTool', 'StationTool');

  public $withAMenu = false;

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
    $this->StationTool->initialize($controller);
  }

  /************************************************************************/
  /* Data finder                                                          */
  /************************************************************************/
  public function getList($options = array(), $isPaging = false) {
    $this->Controller->loadModel('Restaurant');
    if ($this->withAMenu) $this->Controller->Restaurant->bindRecommendedMenu();
    return $this->Controller->_getModelsList('Restaurant', $options, $isPaging);
  }

  public function listByStation($isPaging = false) {
    $options = array();
    $conditions = $this->conditionByStation();
    if ($conditions) {
      $options = array('conditions' => $conditions);
    }
    $this->StationTool->setStationName();
    return $this->getList($options, $isPaging);
  }

  public function recommendedMenus($isPaging = false) {
    // recommendedである事をセッションに記録。その後の検索フィルターに利用
    App::uses('Component', 'MenuToolComponent');
    $this->Controller->Session->write(MenuToolComponent::SESSION_RECOMMENDED, true);
    // データ取得
    $this->withAMenu = true;
    return $this->listByStation($isPaging);
  }

  /************************************************************************/
  /* Validation                                                           */
  /************************************************************************/
  /************************************************************************/
  /* Tools                                                                */
  /************************************************************************/
  public function conditionByStation() {
    // 駅絞り込み
    $this->Controller->loadModel('RestaurantStation');
    $station_id = $this->ParamTool->query_init('station_id');
    if (empty($station_id)) return false;

    $restaurants = $this->Controller->RestaurantStation->findAllByStationId($station_id);
    $restaurant_ids = Set::extract('{n}/Restaurant/id', $restaurants);
    return Restaurant::conditionById($restaurant_ids);
  }
}
