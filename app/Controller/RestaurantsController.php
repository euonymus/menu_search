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
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');



  public function region() {
    $this->_loadComponent('MenuTool');
    $this->loadModel('Station');
    $this->set('stations', $this->Station->find('list'));
  }

/**
 * index method
 *
 * @return void
 */
	public function index() {

	  $this->_loadComponent('MenuTool');
	  $this->_loadComponent('RestaurantTool');
	  $this->set('restaurants', $this->RestaurantTool->listByStation(true));


		/* $this->Restaurant->recursive = 0; */
		/* $this->set('restaurants', $this->Paginator->paginate()); */
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
	  $this->helpers[] = 'Map';

		if (!$this->Restaurant->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant'));
		}
		$options = array('conditions' => array('Restaurant.' . $this->Restaurant->primaryKey => $id));
		$this->Restaurant->bindStation(false);
		$restaurant = $this->Restaurant->find('first', $options);
		$mapInit = array();
		$mapInit['latitude'] = $restaurant['Restaurant']['latitude'];
		$mapInit['longitude'] = $restaurant['Restaurant']['longitude'];
		$this->set(compact('restaurant', 'mapInit'));

	  $this->_loadComponent('MenuTool');
	  $this->set('menus', $this->MenuTool->listByRestaurant($id, true));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	  $this->helpers[] = 'Map';

		if (!$this->Restaurant->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant'));
		}
		$this->Restaurant->bindStation(false);
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Restaurant->save($this->request->data)) {
				$this->_setFlash(__('The restaurant has been saved.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->_setFlash(__('The restaurant could not be saved. Please, try again.'), TRUE);
			}
		} else {
			$options = array('conditions' => array('Restaurant.' . $this->Restaurant->primaryKey => $id));
			$this->request->data = $this->Restaurant->find('first', $options);


			$mapInit = array();
			$mapInit['latitude'] = $this->request->data['Restaurant']['latitude'];
			$mapInit['longitude'] = $this->request->data['Restaurant']['longitude'];
			$this->set(compact('mapInit'));


		}

		$this->loadModel('Station');
		$stations = $this->Station->find('list');
		$this->set(compact('stations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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
