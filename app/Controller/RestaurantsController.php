<?php
App::uses('AppController', 'Controller');
/**
 * Restaurants Controller
 *
 * @property Restaurant $Restaurant
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RestaurantsController extends AppController {
  public $components = array('Paginator', 'Session');

  public function region() {
    $this->_loadComponent('MenuTool');
    $this->loadModel('Station');
    $this->set('stations', $this->Station->find('list'));

    // SEO
    self::$title_for_layout = '駅からレストラン検索 - '.self::$title_for_layout;
    self::$description_for_layout = '駅を選んでレストランを比較！一番好みの食べたい料理を見つけてお店へGo！';
  }

  public function index() {
    $this->helpers[] = 'Restaurant';
    $this->_loadComponent('MenuTool');
    $this->_loadComponent('RestaurantTool');
    $this->_loadComponent('StationTool');
    $this->set('restaurants', $this->RestaurantTool->search(true));
    $this->StationTool->setStationName();

    // html title
    $station = $this->viewVars['station'];
    $currentGeo = $this->viewVars['currentGeo'];
    $title = '';
    if ($station) $title .= $station.'駅周辺の';
    elseif ($currentGeo) {
      $title .= '周辺の';
    }
    $title .= 'レストラン検索結果';
    self::$title_for_layout = $title . ' - '.self::$title_for_layout;
    self::$description_for_layout = $title . 'を人気順に表示します！エリアや種類でランチメニューを選んで比較！一番好みの食べたい料理を見つけてお店へGo！';
  }

  public function view($id = null) {
    $this->helpers[] = 'Map';

    if (!$this->Restaurant->exists($id)) {
      throw new NotFoundException(__('Invalid restaurant'));
    }
    $options = array('conditions' => array('Restaurant.' . $this->Restaurant->primaryKey => $id));
    //$this->Restaurant->bindStation(false);
    $this->Restaurant->bindRestaurantGeo();
    $restaurant = $this->Restaurant->find('first', $options);
    $this->set(compact('restaurant'));
    $this->GeoTool->initMap($restaurant['RestaurantGeo']);

    // Menu list
    $this->_loadComponent('MenuTool');
    $this->set('menus', $this->MenuTool->listByRestaurant($id, true));

    // SEO
    self::$title_for_layout = $restaurant['Restaurant']['name'] . ' - '.self::$title_for_layout;
    self::$description_for_layout = $restaurant['Restaurant']['name'] . ' '.$restaurant['Restaurant']['description'] . ' - ' . self::$description_for_layout;;
  }

  /******************************************************************/
  /* Admin                                                          */
  /******************************************************************/
  public function admin_add() {
    if ($this->request->is('post')) {
      $this->Restaurant->create();
      if ($this->Restaurant->save($this->request->data)) {
	$this->Session->setFlash(__('The restaurant has been saved.'));
	return $this->redirect(array('action' => 'index'));
      } else {
	$this->Session->setFlash(__('The restaurant could not be saved. Please, try again.'));
      }
    }
  }

  public function admin_edit($id = null) {
    $this->helpers[] = 'Map';

    if (!$this->Restaurant->exists($id)) {
      throw new NotFoundException(__('Invalid restaurant'));
    }
    //$this->Restaurant->bindStation(false);
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Restaurant->saveAll($this->request->data)) {
	$this->_setFlash(__('The restaurant has been saved.'));
	$this->GeoTool->initMap($this->request->data['RestaurantGeo']);
	//return $this->redirect(array('action' => 'index'));
      } else {
	$this->_setFlash(__('The restaurant could not be saved. Please, try again.'), TRUE);
      }
    } else {
      $options = array('conditions' => array('Restaurant.' . $this->Restaurant->primaryKey => $id));
      $this->Restaurant->bindRestaurantGeo();
      $this->request->data = $this->Restaurant->find('first', $options);
      $this->GeoTool->initMap($this->request->data['RestaurantGeo']);
    }
    
    //$this->loadModel('Station');
    //$stations = $this->Station->find('list');
    //$this->set(compact('stations'));
  }

  public function admin_delete($id = null) {
    $this->Restaurant->id = $id;
    if (!$this->Restaurant->exists()) {
      throw new NotFoundException(__('Invalid restaurant'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Restaurant->delete()) {
      $this->Session->setFlash(__('The restaurant has been deleted.'));
    } else {
      $this->Session->setFlash(__('The restaurant could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }
}
