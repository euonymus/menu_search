<?php
App::uses('Component', 'Controller');
class RestaurantToolComponent extends Component {
  public $components = array('ParamTool', 'StationTool');

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
    return $this->Controller->_getModelsList('Restaurant', $options, $isPaging);
  }

  public function listByStation($isPaging = false) {
    $options = array();

    // 駅絞り込み
    $this->Controller->loadModel('RestaurantStation');
    $station_id = $this->ParamTool->query_init('station');
    if (!empty($station_id)) {
      $restaurants = $this->Controller->RestaurantStation->findAllByStationId($station_id);
      $restaurant_ids = Set::extract('{n}/Restaurant/id', $restaurants);
      $options = array('conditions' => Restaurant::conditionById($restaurant_ids));
    }
    $this->StationTool->setStationName();
    return $this->getList($options, $isPaging);
  }

  /************************************************************************/
  /* Validation                                                           */
  /************************************************************************/
  /************************************************************************/
  /* Tools                                                                */
  /************************************************************************/
}
