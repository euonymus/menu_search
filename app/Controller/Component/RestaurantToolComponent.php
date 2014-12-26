<?php
App::uses('Component', 'Controller');
class RestaurantToolComponent extends Component {
  public $components = array('ParamTool');

  public $withAMenu = false;

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
  }

  /************************************************************************/
  /* Data finder                                                          */
  /************************************************************************/
  public function getList($options = array(), $isPaging = false) {
    $this->Controller->loadModel('Restaurant');
    if ($this->withAMenu) $this->Controller->Restaurant->bindRecommendedMenu();
    return $this->Controller->_getModelsList('Restaurant', $options, $isPaging);
  }

  public function search($isPaging = false) {
    $center = $this->getLatLngCenter();
    if (!$center) return false;
    return $this->listInRange($isPaging, $center['latitude'], $center['longitude']);
  }

  public function listInRange($isPaging = false, $latitude = false, $longitude = false) {
    $conditions = $this->inRangeConditions($latitude, $longitude);
    $options = array('conditions' => $conditions);
    if ($conditions) $options['order'] = "FIELD(Restaurant.id,".implode(',',$conditions['Restaurant.id']).")";
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
  /* Tools                                                                */
  /************************************************************************/
  public function getLatLngCenter() {
    $ret = array();
    // If station_id is set on query_string
    $station_id = $this->ParamTool->query_init('station_id');
    if (!empty($station_id)) {
      $this->Controller->loadModel('Station');
      $station = $this->Controller->Station->findById($station_id);
      if (empty($station)) return false;
      $ret['latitude'] = $station['Station']['latitude'];
      $ret['longitude'] = $station['Station']['longitude'];
    } else {
      $geo = $this->Controller->geo;
      if (!$geo) return false;
      $ret['latitude'] = $geo['coords']['latitude'];
      $ret['longitude'] = $geo['coords']['longitude'];
    }
    return $ret;
  }

  public function inRangeConditions($latitude = false, $longitude = false, $distance = 1000) {
    $this->Controller->loadModel('RestaurantGeo');
    $tmpOpt = array('conditions' => RestaurantGeo::conditionInRange($latitude, $longitude, $distance));
    $tmpOpt['order'] = array('RestaurantGeo.distance' => 'ASC');
    $restaurant_ids = Set::extract('{n}/RestaurantGeo/id', $this->Controller->RestaurantGeo->find('all', $tmpOpt));
    if (empty($restaurant_ids)) return false;
    App::uses('Restaurant', 'Model');
    return Restaurant::conditionById($restaurant_ids);
  }

  /************************************************************************/
  /* legacy                                                               */
  /************************************************************************/
  /*
  public function listByStation($isPaging = false) {
    $options = array();
    $conditions = $this->searchConditions();
    if ($conditions) {
      $options = array('conditions' => $conditions);
    }
    $this->StationTool->setStationName();
    return $this->getList($options, $isPaging);
  }

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
  */
}
