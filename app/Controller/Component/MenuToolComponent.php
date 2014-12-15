<?php
App::uses('Component', 'Controller');
class MenuToolComponent extends Component {
  public $components = array('ParamTool', 'GeoTool');

  const SESSION_NEXT_PAGE = 'next';
  const SESSION_TAGS      = 'tags';
  const SESSION_STATION   = 'station_id';
  const SESSION_LIKE      = 'like';
  const SESSION_RECOMMENDED = 'recommended';

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
    $this->GeoTool->initialize($controller);
  }

  /************************************************************************/
  /* Data finder                                                          */
  /************************************************************************/
  public function getList($options = array(), $isPaging = false) {
    $this->Controller->loadModel('Menu');
    $this->Controller->Menu->bindRestaurant();
    $options['order'] = array('Menu.point' => 'DESC');
    return $this->Controller->_getModelsList('Menu', $options, $isPaging);
  }

  public static function degreePerSec() {
    return (1 / (60 * 60));
  }
  public static function latRange($latitude, $range = 500/* m */) {
    // 30.8184の求め方は http://blog.epitaph-t.com/?p=172 参照
    $delta = (($range / 30.8184) * self::degreePerSec());
    // 緯度(500mプラス) ＝ 基準の緯度 + (範囲 ÷ 1秒当たりの緯度 × 1秒当たりの度)
    return array('posi' => ($latitude + $delta), 'nega' => ($latitude - $delta));
  }
  public static function lngRange($longitude, $range = 500/* m */) {
    // 25.2450の求め方は http://blog.epitaph-t.com/?p=172 参照
    $delta = (($range / 25.2450) * self::degreePerSec());
    // 経度(500mプラス) ＝ 基準の経度 + (範囲 ÷ 1秒当たりの緯度 × 1秒当たりの度)
    return array('posi' => ($longitude + $delta), 'nega' => ($longitude - $delta));
  }

  public function search($isPaging = false) {
    /*
    $geo = $this->GeoTool->read(true);
    $latitude = $geo['coords']['latitude'];
    $longitude = $geo['coords']['longitude'];

    $latRange = self::latRange('35.71654578');
    pr($latRange);

    $latRange = self::lngRange('139.777254');
    pr($latRange);



SELECT 
  id, name, lat, lng, geom 
FROM 
  geos 
WHERE 
  MBRContains(GeomFromText('LineString(139.782756 35.72105247, 139.771752 35.71203906)'), geom)

    */


    




    $conditions = $this->searchConditions();
    if ($conditions) {
      $options = array('conditions' => $conditions);
    } else {
      $options = array();
    }
    return $this->getList($options, $isPaging);
  }

  public function likes($isPaging = false) {
    // likesである事をセッションに記録。その後の検索フィルターに利用
    $this->Controller->Session->write(self::SESSION_LIKE, true);
    // データ取得
    $this->Controller->loadModel('MenuUser');
    $menuUsers = $this->Controller->MenuUser->findAllByUserId($this->Controller->currentUser['id'], array('menu_id'));
    $conditions = array('Menu.id' => Set::extract('{n}/MenuUser/menu_id', $menuUsers));

    $searchCondition = $this->searchConditions();
    if ($searchCondition) {
      $conditions = am($conditions, $searchCondition);
    }
    $options = array('conditions' => $conditions);
    return $this->getList($options, $isPaging);
  }

  public function listByRestaurant($restaurant_id, $isPaging = false) {
    $this->Controller->loadModel('Menu');
    $options = array('conditions' => Menu::conditionByRestaurantId($restaurant_id));
    return $this->getList($options, $isPaging);
  }

  /************************************************************************/
  /* Tools                                                                */
  /************************************************************************/
  public function searchConditions() {
    $tags       = $this->ParamTool->query_init(self::SESSION_TAGS);
    $station_id = $this->ParamTool->query_init(self::SESSION_STATION);
    $this->Controller->set(compact('tags','station_id'));
    if (!$tags && !$station_id) return false;

    // タグ絞り込み
    $this->Controller->loadModel('Menu');
    $conditions = Menu::conditionByTags($tags);
    if ($conditions) {
      $this->Controller->Session->write(self::SESSION_TAGS, $tags);
    }

    // 駅絞り込み
    if (!empty($station_id)) {
      $this->Controller->Session->write(self::SESSION_STATION, $station_id);

      $this->Controller->loadModel('RestaurantStation');
      $restaurants = $this->Controller->RestaurantStation->findAllByStationId($station_id);
      $restaurant_ids = Set::extract('{n}/Restaurant/id', $restaurants);
      $conditionsRestaurant = Menu::conditionByRestaurantId($restaurant_ids);
      $conditions = am($conditions, $conditionsRestaurant);
    }
    return $conditions;
  }

  public function sessionFilter($sessionName) {
    $this->Controller->Session->delete($sessionName);
    $this->Controller->_loadComponent('ParamTool');
    if ($query = $this->Controller->ParamTool->query_init($sessionName)) {
      $this->Controller->Session->write($sessionName, $query);
      // Prepare the next page
      $this->Controller->redirect($this->prepareNextPath());
    } else {
      $this->searchInit();
    }
  }

  public function searchInit() {
    $this->Controller->_loadComponent('ParamTool');
    // Refresh
    if ($this->Controller->ParamTool->named_init('refresh')) {
      $this->Controller->Session->delete(self::SESSION_NEXT_PAGE);
      $this->Controller->Session->delete(self::SESSION_TAGS);
      $this->Controller->Session->delete(self::SESSION_STATION);
      $this->Controller->Session->delete(self::SESSION_LIKE);
      $this->Controller->Session->delete(self::SESSION_RECOMMENDED);
    }
    // Redirect destination
    $next = $this->Controller->ParamTool->named_init(self::SESSION_NEXT_PAGE);
    if (in_array($next, array('region','categories','index','likes','recommended'))) {
      $next = $next;
    } elseif($this->Controller->Session->read(self::SESSION_LIKE)) {
      $next = 'likes';
    } elseif($this->Controller->Session->read(self::SESSION_RECOMMENDED)) {
      $next = 'recommended';
    } else {
      $next = 'index';
    }
    $this->Controller->Session->write(self::SESSION_NEXT_PAGE, $next);
  }

  public function prepareNextPath() {
    $next = $this->Controller->Session->read(self::SESSION_NEXT_PAGE);
    if (empty($next)) $next = 'index';
    $this->Controller->Session->delete(self::SESSION_NEXT_PAGE);
    if (($next != 'index') && ($next != 'likes') && ($next != 'recommended')) return '/menus/' . $next . '/';

    $query = array();
    $station_id = $this->Controller->Session->read(self::SESSION_STATION);
    if (!empty($station_id)) {
      $q_station = array(self::SESSION_STATION => $station_id);
      $query = am($query, $q_station);
    }
    $tags = $this->Controller->Session->read(self::SESSION_TAGS);
    if (!empty($tags)) {
      $q_tags = array(self::SESSION_TAGS => $tags);
      $query = am($query, $q_tags);
    }
    return array('controller' => 'menus', 'action' => $next, '?' => $query);
  }
}
