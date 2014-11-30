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



  public function index() {
    $this->_loadComponent('MenuTool');
    $this->set('menus', $this->MenuTool->getList(array(),true));
  }



  public function categories() {
    self::$title_for_layout = '検索メニュー選択:'.self::$title_for_layout;
    $this->_loadComponent('StationTool');
    $this->StationTool->setStationName();
  }

  public function region() {
    $this->loadModel('Station');
    $this->set('stations', $this->Station->find('list'));

    $this->_loadComponent('ParamTool');
    $tags = $this->ParamTool->query_init('tags');
    $this->set(compact('tags'));
  }



  public function search() {
    $this->_loadComponent('MenuTool');
    $this->set('menus', $this->MenuTool->search(true));
    $this->_loadComponent('StationTool');
    $this->StationTool->setStationName();
  }

  public function view($id = null) {
    if (!$this->Menu->exists($id)) {
      throw new NotFoundException(__('Invalid menu'));
    }
    $options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
    $this->Menu->bindRestaurant(false);
    $this->set('menu', $this->Menu->find('first', $options));
  }

  /******************************************************************/
  /* API                                                            */
  /******************************************************************/
  public function api_search() {
    $this->_loadComponent('MenuTool');
    $this->set('menus', $this->MenuTool->search(true));
    $this->set('_serialize', array('menus'));
  }

/**
 * add method
 *
 * @return void
 */
  public function add() {
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function edit($id = null) {
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
  public function delete($id = null) {
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
