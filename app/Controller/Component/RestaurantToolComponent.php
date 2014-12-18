<?php
App::uses('Component', 'Controller');
class RestaurantToolComponent extends Component {
  public $components = array('ParamTool', 'StationTool', 'GeoTool');

  public $withAMenu = false;

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
    $this->StationTool->initialize($controller);
    $this->GeoTool->initialize($controller);
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
    $conditions = $this->searchConditions();
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
  public function searchConditions() {
    App::uses('Restaurant', 'Model');
    $this->Controller->loadModel('RestaurantStation');
    $geo        = $this->GeoTool->read(true);
    $station_id = $this->ParamTool->query_init('station_id');
    if (!$station_id && !$geo) return false;

    if (!empty($station_id)) {
    // 駅絞り込み
      $restaurants = $this->Controller->RestaurantStation->findAllByStationId($station_id);
      $restaurant_ids = Set::extract('{n}/Restaurant/id', $restaurants);
      $conditions =  Restaurant::conditionById($restaurant_ids);
    } elseif ($geo) {
    // 周辺絞り込み
      $latitude = $geo['coords']['latitude'];
      $longitude = $geo['coords']['longitude'];
      $this->Controller->loadModel('RestaurantGeo');
      $tmpOpt = array('conditions' => RestaurantGeo::conditionInRange($latitude, $longitude,4000));
      $restaurant_ids = Set::extract('{n}/RestaurantGeo/id', $this->Controller->RestaurantGeo->find('all', $tmpOpt));
      $conditions =  Restaurant::conditionById($restaurant_ids);
    }
    return $conditions;
  }
}
