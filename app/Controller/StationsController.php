<?php
App::uses('AppController', 'Controller');
/**
 * Stations Controller
 *
 * @property Station $Station
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class StationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Station->recursive = 0;
		$this->set('stations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Station->exists($id)) {
			throw new NotFoundException(__('Invalid station'));
		}
		$options = array('conditions' => array('Station.' . $this->Station->primaryKey => $id));
		$this->set('station', $this->Station->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Station->create();
			if ($this->Station->save($this->request->data)) {
				$this->Session->setFlash(__('The station has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The station could not be saved. Please, try again.'));
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
		if (!$this->Station->exists($id)) {
			throw new NotFoundException(__('Invalid station'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Station->save($this->request->data)) {
				$this->Session->setFlash(__('The station has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The station could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Station.' . $this->Station->primaryKey => $id));
			$this->request->data = $this->Station->find('first', $options);
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
		$this->Station->id = $id;
		if (!$this->Station->exists()) {
			throw new NotFoundException(__('Invalid station'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Station->delete()) {
			$this->Session->setFlash(__('The station has been deleted.'));
		} else {
			$this->Session->setFlash(__('The station could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
