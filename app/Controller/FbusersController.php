<?php
App::uses('AppController', 'Controller');
/**
 * Fbusers Controller
 *
 * @property Fbuser $Fbuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FbusersController extends AppController {

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
		$this->Fbuser->recursive = 0;
		$this->set('fbusers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Fbuser->exists($id)) {
			throw new NotFoundException(__('Invalid fbuser'));
		}
		$options = array('conditions' => array('Fbuser.' . $this->Fbuser->primaryKey => $id));
		$this->set('fbuser', $this->Fbuser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Fbuser->create();
			if ($this->Fbuser->save($this->request->data)) {
				$this->Session->setFlash(__('The fbuser has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fbuser could not be saved. Please, try again.'));
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
		if (!$this->Fbuser->exists($id)) {
			throw new NotFoundException(__('Invalid fbuser'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Fbuser->save($this->request->data)) {
				$this->Session->setFlash(__('The fbuser has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fbuser could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Fbuser.' . $this->Fbuser->primaryKey => $id));
			$this->request->data = $this->Fbuser->find('first', $options);
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
		$this->Fbuser->id = $id;
		if (!$this->Fbuser->exists()) {
			throw new NotFoundException(__('Invalid fbuser'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Fbuser->delete()) {
			$this->Session->setFlash(__('The fbuser has been deleted.'));
		} else {
			$this->Session->setFlash(__('The fbuser could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
