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
    $this->Auth->deny('like', 'likes');
  }

  public function index() {
    $this->_loadComponent('MenuTool');

    $this->set('menus', $this->MenuTool->search(true));
    $this->_loadComponent('StationTool');
    $this->StationTool->setStationName();
  }

  public function recommended() {
    $this->_loadComponent('MenuTool');
    $this->_loadComponent('RestaurantTool');
    $this->set('menus', $this->RestaurantTool->recommendedMenus(true));
  }

  public function likes() {
    $this->_loadComponent('MenuTool');
    $this->MenuTool->searchInit();
    $this->set('menus', Set::extract('{n}/Menu', $this->MenuTool->likes(true)));
  }

  public function categories() {
    self::$title_for_layout = '検索メニュー選択:'.self::$title_for_layout;
    self::$description_for_layout = '料理の名前を選んでお店毎のメニューを比較！一番好みの食べたい料理を見つけてお店へGo！';

    $this->_loadComponent('MenuTool');
    $this->MenuTool->sessionFilter(MenuToolComponent::SESSION_TAGS);
    // Set View Values
    $this->_loadComponent('StationTool');
    $this->StationTool->setStationName();
  }

  public function region() {
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

    $this->loadModel('MenuUser');
    $menuUser = $this->MenuUser->find('first', array('conditions' => MenuUser::conditionUnique($id, $this->currentUser['id'])));
    if (empty($menuUser)) $liked = false;
    else $liked = true;
    $this->set('liked', $liked);

    $options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
    $this->Menu->bindRestaurant(false);
    $this->Menu->recursive = 2;
    $this->Menu->Restaurant->bindRestaurantGeo();

    $menu = $this->Menu->find('first', $options);
    $this->set('menu', $menu);
    $this->GeoTool->initMap($menu['Restaurant']['RestaurantGeo']);
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

  public function add() {
    $this->Menu->bindRestaurant(false);
    // TODO: 文字列 => 文字列で半径30m以内のリストに変更
    // $this->Menu->Restaurant->nearList($latitude, $longitude)
    $geo = $this->GeoTool->read(true);
    if (empty($geo)) {
      $restaurantList = array();
    } else {
      $latitude  = $geo['coords']['latitude'];
      $longitude = $geo['coords']['longitude'];
      $restaurantList = $this->Menu->Restaurant->nearList($latitude, $longitude);
    }
    $this->set('restaurantList', $restaurantList);

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

  /******************************************************************/
  /* API                                                            */
  /******************************************************************/
  public function api_search() {
    $this->_loadComponent('MenuTool');
    $this->set('menus', $this->MenuTool->search(true));
    $this->set('_serialize', array('menus'));
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
}
