<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MenusController extends AppController {
  public $components = array('Paginator', 'Session', 'RequestHandler');
  public $helpers = array('Menu');

  const FULLTEXT_MIN_SCORE = 50;

  public function beforeFilter() {
    parent::beforeFilter();
    //ログインが必要なアクション
    $this->Auth->deny('like', 'likes', 'add', 'add_restaurant');
  }

  public function index() {
    $this->_loadComponent('MenuTool');

    $this->set('menus', $this->MenuTool->search(true));
    $this->_loadComponent('StationTool');
    $this->StationTool->setStationName();

    // html title
    $station = $this->viewVars['station'];
    $tags = $this->viewVars['tags'];
    $currentGeo = $this->viewVars['currentGeo'];
    $title = '';
    if ($station) $title .= $station.'駅周辺の';
    elseif ($currentGeo) {
      $title .= '周辺の';
    }
    if ($tags) $title .= $tags;
    else $title .= 'ランチメニュー';
    $title .= '検索結果';
    self::$title_for_layout = $title . ' - '.self::$title_for_layout;
    self::$description_for_layout = $title . 'を人気順に表示します！エリアや種類でランチメニューを選んで比較！一番好みの食べたい料理を見つけてお店へGo！';
  }

  public function likes() {
    $this->_loadComponent('MenuTool');
    //$this->MenuTool->initNext();
    $this->set('menus', $this->MenuTool->likes(true));
    self::$title_for_layout = 'お気に入りに登録したランチメニュー - '.self::$title_for_layout;
    self::$description_for_layout = '食べたいランチメニューをお気に入り登録していつでもレストランを調べる事ができちゃう！エリアや種類でランチメニューを選んで比較！一番好みの食べたい料理を見つけてお店へGo！';
  }

  public function categories() {
    self::$title_for_layout = '種類でランチメニュー検索 - '.self::$title_for_layout;
    self::$description_for_layout = '料理の名前を選んでお店毎のランチメニューを比較！一番好みの食べたい料理を見つけてお店へGo！';

    $this->_loadComponent('MenuTool');
    $this->MenuTool->sessionFilter(MenuToolComponent::SESSION_TAGS);
    // Set View Values
    $this->_loadComponent('StationTool');
    $this->StationTool->setStationName();
  }

  public function region() {
    self::$title_for_layout = '駅からランチメニュー検索 - '.self::$title_for_layout;
    self::$description_for_layout = '駅を選んでランチメニューを比較！一番好みの食べたい料理を見つけてお店へGo！';

    $this->_loadComponent('MenuTool');
    $this->MenuTool->sessionFilter(MenuToolComponent::SESSION_STATION);

    // Set View Values
    $this->loadModel('Station');
    $stations = $this->Station->find('list');
    $tags = $this->Session->read(MenuToolComponent::SESSION_TAGS);
    $this->set(compact('stations','tags'));
  }

  public function view($id = null) {
    $this->helpers[] = 'Map';

    if (!$this->Menu->exists($id)) {
      throw new NotFoundException(__('Invalid menu'));
    }
    // like check
    $this->loadModel('MenuUser');
    $menuUser = $this->MenuUser->find('first', array('conditions' => MenuUser::conditionUnique($id, $this->currentUser['id'])));
    if (empty($menuUser)) $liked = false;
    else $liked = true;
    $this->set('liked', $liked);
    // get menu data
    $options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
    $this->Menu->bindRestaurant(false);
    $this->Menu->bindMenuImage(false);
    $this->Menu->bindMenuRegistrant(false);
    $this->Menu->recursive = 2;
    $this->Menu->Restaurant->bindRestaurantGeo();
    $menu = $this->Menu->find('first', $options);
    $this->set('menu', $menu);
    // init map
    $this->GeoTool->initMap($menu['Restaurant']['RestaurantGeo']);
    // Tag検索のためにセッション内のstation_idを取得しておく。
    $this->_loadComponent('MenuTool');
    $station_id = $this->Session->read(MenuToolComponent::SESSION_STATION);
    $this->set(compact('station_id'));

    // SEO
    self::$title_for_layout = $menu['Restaurant']['name'] .'の'. $menu['Menu']['name'] . ' - '.self::$title_for_layout;
    self::$description_for_layout = $menu['Restaurant']['name'] .'の'. $menu['Menu']['name'] . ' '.$menu['Menu']['description'] . ' '.$menu['Menu']['remarks'];
    if (!empty($menu['Menu']['image'])) $socialImage = $menu['Menu']['image'];
    $this->set(compact('socialImage'));
  }

  public function like($id = false) {
    if (!$id) return $this->redirect(array('action' => 'index'));

    $this->_loadComponent('ParamTool');
    $undo = $this->ParamTool->named_init('undo');

    $this->loadModel('MenuUser');
    if ($undo) {
      $saved = $this->MenuUser->deleteUnique($id, $this->currentUser['id']);
      $success_message = __('お気に入り解除しました');
      $failed_message = __('お気に入り解除に失敗しました');
    } else {
      $saved = $this->MenuUser->saveNew($id, $this->currentUser['id']);
      $success_message = __('メニューをお気に入り登録しました');
      $failed_message = __('お気に入り登録に失敗しました');
    }
    if ($saved) {
      $this->loadModel('Menu');
      $updated = $this->Menu->updatePoint($id);
      if (!$updated) {
	LogTool::error('Failed to update menu point. id='.$id);
      }
      $this->_setFlash($success_message);
    } else {
      $this->_setFlash($failed_message, TRUE);
    }
    return $this->redirect(array('action' => 'view', $id));
  }

  public function add_restaurant() {
    $this->loadModel('Restaurant');

    $geo = $this->geo;
    if (empty($geo)) {
      $restaurantList = array();
    } else {
      $latitude  = $geo['coords']['latitude'];
      $longitude = $geo['coords']['longitude'];
      // 選択された文字列(postデータ)の緯度経度を設定するため
      //$restaurantList = $this->Restaurant->nearList($latitude, $longitude);
      //$restaurantList = $this->Restaurant->nearList($latitude, $longitude);
      $this->Restaurant->bindRestaurantGeo(false);
      $restaurant = $this->Restaurant->near($latitude, $longitude);
      $restaurantList = array();
      foreach($restaurant as $val) {
	$restaurantList[$val['Restaurant']['name']] = $val['Restaurant']['name'];
      }
    }
    $this->set('restaurantList', $restaurantList);

    if ($this->request->is('post')) {
      // restaurant tableから選択された場合はテーブル内のgeo情報を設定する。
      if (empty($this->request->data['RestaurantGeo']['latitude']) || empty($this->request->data['RestaurantGeo']['longitude'])){
	foreach($restaurant as $key => $val) {
	  if ($this->request->data['Restaurant']['name'] == $val['Restaurant']['name']) {
	    $this->request->data['RestaurantGeo']['latitude'] = $val['RestaurantGeo']['latitude'];
	    $this->request->data['RestaurantGeo']['longitude'] = $val['RestaurantGeo']['longitude'];
	  }
	}
      }
      $saved = $this->Restaurant->saveIfNotExist($this->request->data);
      if ($saved) {
	return $this->redirect(array('action' => 'add', $saved));
      } else {
	$this->_setFlash(__('The restaurant could not be saved.'), true);
      }
    }
  }

  public function add($restaurant_id = false) {
    $this->loadModel('Restaurant');
    $restaurant = $this->Restaurant->findById($restaurant_id);
    if (empty($restaurant)) {
      throw new NotFoundException(__('Invalid restaurant'));
    }
    $menuList = $this->Menu->listByRestaurant($restaurant_id);
    $this->set(compact('restaurant', 'menuList'));

    $this->loadModel('MenuTag');
    $this->set('menuTagList', $this->MenuTag->getList());

    if ($this->request->is('post')) {
      $this->Menu->create();
      if ($id = $this->Menu->saveForm($this->request->data)) {
	// userが食べたランチを登録
        $this->loadModel('MenuRegistrant');
	if ($this->MenuRegistrant->saveRelation($id, $this->currentUser['id'])) {
	  $this->_setFlash(__('The menu has been saved.'));
	}
	// ランチの写真を登録
        $this->loadModel('MenuImage');
	if ($this->MenuImage->saveRelation($this->request->data['NoModel'], $id, $this->currentUser['id'])) {
	  //$this->_setFlash(__('The menu has been saved.'));
	}
      	return $this->redirect(array('action' => 'view', $id));
      } else {
      	$this->_setFlash(__('The menu could not be saved. Please, try again.'), TRUE);
      }
    }
  }

  /******************************************************************/
  /* API                                                            */
  /******************************************************************/
  public function api_search() {
    $this->_loadComponent('MenuTool');
    $menus = $this->MenuTool->search(true);
    $this->set(array(
		     'menus' => $menus,
		     '_serialize' => array('menus'),
		     '_jsonp' => true
    ));
  }

  /******************************************************************/
  /* Admin                                                          */
  /******************************************************************/
  public function admin_init() {
    $this->autoRender = false;
    echo 'init menus, restaurants and restaurant_geos table';

    $this->loadModel('Menu');
    $this->Menu->initMenuData();
  }

  public function admin_add() {
    $this->Menu->bindRestaurant(false);
    $this->set('restaurantList', $this->Menu->Restaurant->getList());

    $this->loadModel('MenuTag');
    $this->set('menuTagList', $this->MenuTag->getList());

    if ($this->request->is('post')) {
      $this->Menu->create();
      if ($this->Menu->save($this->request->data)) {
	$this->_setFlash(__('The menu has been saved.'));
	return $this->redirect(array('action' => 'index'));
      } else {
	$this->_setFlash(__('The menu could not be saved. Please, try again.'), TRUE);
      }
    }
  }

  public function admin_edit($id = null) {
    $this->Menu->bindRestaurant(false);
    $this->set('restaurantList', $this->Menu->Restaurant->getList());

    if (!$this->Menu->exists($id)) {
      throw new NotFoundException(__('Invalid menu'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Menu->save($this->request->data)) {
	$this->_setFlash(__('The menu has been saved.'));
	/* return $this->redirect(array('action' => 'index')); */
      } else {
	$this->_setFlash(__('The menu could not be saved. Please, try again.'), TRUE);
      }
    } else {
      $options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
      $this->request->data = $this->Menu->find('first', $options);
    }
  }

  public function admin_delete($id = null) {
    $this->Menu->id = $id;
    if (!$this->Menu->exists()) {
      throw new NotFoundException(__('Invalid menu'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Menu->delete()) {
      $this->Session->setFlash(__('The menu has been deleted.'));
    } else {
      $this->Session->setFlash(__('The menu could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }

  /******************************************************************/
  /* Legacy                                                         */
  /******************************************************************/
  public function recommended() {
    $this->_loadComponent('MenuTool');
    $this->_loadComponent('RestaurantTool');
    $this->set('menus', $this->RestaurantTool->recommendedMenus(true));
  }
}
