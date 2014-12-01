<?php
App::uses('AppController', 'Controller');
/**
 * Twusers Controller
 *
 * @property Twuser $Twuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TwusersController extends AppController {

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
		$this->Twuser->recursive = 0;
		$this->set('twusers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Twuser->exists($id)) {
			throw new NotFoundException(__('Invalid twuser'));
		}
		$options = array('conditions' => array('Twuser.' . $this->Twuser->primaryKey => $id));
		$this->set('twuser', $this->Twuser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Twuser->create();
			if ($this->Twuser->save($this->request->data)) {
				$this->Session->setFlash(__('The twuser has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The twuser could not be saved. Please, try again.'));
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
		if (!$this->Twuser->exists($id)) {
			throw new NotFoundException(__('Invalid twuser'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Twuser->save($this->request->data)) {
				$this->Session->setFlash(__('The twuser has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The twuser could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Twuser.' . $this->Twuser->primaryKey => $id));
			$this->request->data = $this->Twuser->find('first', $options);
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
		$this->Twuser->id = $id;
		if (!$this->Twuser->exists()) {
			throw new NotFoundException(__('Invalid twuser'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Twuser->delete()) {
			$this->Session->setFlash(__('The twuser has been deleted.'));
		} else {
			$this->Session->setFlash(__('The twuser could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
