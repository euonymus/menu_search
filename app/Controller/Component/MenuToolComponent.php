<?php
App::uses('Component', 'Controller');
class MenuToolComponent extends Component {
  public $components = array('ParamTool');

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
  }

  /************************************************************************/
  /* Data finder                                                          */
  /************************************************************************/
  public function getList($options = array(), $isPaging = false) {
    $this->Controller->loadModel('Menu');
    $this->Controller->Menu->bindRestaurant();
    return $this->Controller->_getModelsList('Menu', $options, $isPaging);
  }

  public function search($isPaging = false, $showAll = false) {
    if ($showAll) {
      $options = array();
    } else {
      // タグ絞り込み
      $this->Controller->loadModel('Menu');
      $tags = $this->ParamTool->query_init('tags');
      $options = array('conditions' => Menu::conditionByTags($tags));

      // 駅絞り込み
      $this->Controller->loadModel('RestaurantStation');
      $station_id = $this->ParamTool->query_init('station');
      if (!empty($station_id)) {
      	$restaurants = $this->Controller->RestaurantStation->findAllByStationId($station_id);
      	$restaurant_ids = Set::extract('{n}/Restaurant/id', $restaurants);
      	$options['conditions'][] = Menu::conditionByRestaurantId($restaurant_ids);
      }
      $this->Controller->set(compact('tags'));
    }
    return $this->getList($options, $isPaging);
  }

  public function listByRestaurant($restaurant_id, $isPaging = false) {
    $this->Controller->loadModel('Menu');
    $options = array('conditions' => Menu::conditionByRestaurantId($restaurant_id));
    return $this->getList($options, $isPaging);
  }

  /************************************************************************/
  /* Validation                                                           */
  /************************************************************************/
  /************************************************************************/
  /* Tools                                                                */
  /************************************************************************/
}
