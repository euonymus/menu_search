<?php
App::uses('Component', 'Controller');
class MenuToolComponent extends Component {
  public $components = array('ParamTool', 'RestaurantTool');

  const SESSION_NEXT_PAGE = 'next';
  const SESSION_TAGS      = 'tags';
  const SESSION_STATION   = 'station_id';
  const SESSION_LIKE      = 'like';
  const SESSION_RECOMMENDED = 'recommended';

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
    $this->RestaurantTool->initialize($controller);
  }

  /************************************************************************/
  /* Data finder                                                          */
  /************************************************************************/
  public function getList($options = array(), $isPaging = false) {
    $this->Controller->loadModel('Menu');
    $this->Controller->Menu->bindRestaurant();
    $options['order'] = array('Menu.point' => 'DESC');
    // If Menu.restaurant_id exists, order should be written
    if (isset($options['conditions']['Menu.restaurant_id']) && is_array($options['conditions']['Menu.restaurant_id'])) {
      $options['order']
	= "Menu.point DESC, FIELD(Menu.restaurant_id,".implode(',',$options['conditions']['Menu.restaurant_id']).")";
    }
    return $this->Controller->_getModelsList('Menu', $options, $isPaging);
  }

  public function search($isPaging = false) {
    $conditions = $this->searchConditions();
    if ($conditions) {
      $options = array('conditions' => $conditions);
    } else {
      $options = array();
    }
    return $this->getList($options, $isPaging);
  }

  public function likes($isPaging = false) {
    $this->sessionInit();
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
    $center = $this->RestaurantTool->getLatLngCenter();
    $station_id = $this->ParamTool->query_init(self::SESSION_STATION);
    $this->Controller->set(compact('tags','station_id'));
    if (!$tags && !$center) {
      $this->Controller->Session->delete(self::SESSION_STATION);
      return false;
    }
    if (!empty($station_id)) {
      $this->Controller->Session->write(self::SESSION_STATION, $station_id);
    }

    // タグ絞り込み
    $this->Controller->loadModel('Menu');
    $conditions = Menu::conditionByTags($tags);
    if ($conditions) {
      $this->Controller->Session->write(self::SESSION_TAGS, $tags);
    }
    // 検索中心。中心が無い場合（周辺サポート対象外エリアの場合含む）はタグ絞りのみで返却。
    if (!$center) return $conditions;

    $this->Controller->loadModel('RestaurantGeo');
    $tmpOpt = array('conditions' => RestaurantGeo::conditionInRange($center['latitude'], $center['longitude'], 1000));
    $tmpOpt['order'] = array('RestaurantGeo.distance' => 'ASC');
    $restaurant_ids = Set::extract('{n}/RestaurantGeo/id', $this->Controller->RestaurantGeo->find('all', $tmpOpt));
    $conditionsRestaurant = Menu::conditionByRestaurantId($restaurant_ids);
    return am($conditions, $conditionsRestaurant);
  }

  public function sessionFilter($sessionName) {
    $this->Controller->Session->delete($sessionName);
    $this->Controller->_loadComponent('ParamTool');
    if ($query = $this->Controller->ParamTool->query_init($sessionName)) {
      $this->Controller->Session->write($sessionName, $query);
      // Prepare the next page
      $this->Controller->redirect($this->prepareNextPath());
    } else {
      // Refresh
      if ($this->Controller->ParamTool->named_init('refresh')) {
	$this->sessionInit();
      }
      $this->initNext();
    }
  }

  public function sessionInit() {
    $this->Controller->Session->delete(self::SESSION_NEXT_PAGE);
    $this->Controller->Session->delete(self::SESSION_TAGS);
    $this->Controller->Session->delete(self::SESSION_STATION);
    $this->Controller->Session->delete(self::SESSION_LIKE);
    $this->Controller->Session->delete(self::SESSION_RECOMMENDED);
  }

  public function initNext() {
    $this->Controller->_loadComponent('ParamTool');
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
