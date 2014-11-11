<?php
App::uses('AppController', 'Controller');
/**
 * MenuTags Controller
 *
 * @property MenuTag $MenuTag
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MenuTagsController extends AppController {

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
		$this->MenuTag->recursive = 0;
		$this->set('menuTags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MenuTag->exists($id)) {
			throw new NotFoundException(__('Invalid menu tag'));
		}
		$options = array('conditions' => array('MenuTag.' . $this->MenuTag->primaryKey => $id));
		$this->set('menuTag', $this->MenuTag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MenuTag->create();
			if ($this->MenuTag->save($this->request->data)) {
				$this->Session->setFlash(__('The menu tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu tag could not be saved. Please, try again.'));
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
		if (!$this->MenuTag->exists($id)) {
			throw new NotFoundException(__('Invalid menu tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MenuTag->save($this->request->data)) {
				$this->Session->setFlash(__('The menu tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MenuTag.' . $this->MenuTag->primaryKey => $id));
			$this->request->data = $this->MenuTag->find('first', $options);
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
		$this->MenuTag->id = $id;
		if (!$this->MenuTag->exists()) {
			throw new NotFoundException(__('Invalid menu tag'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MenuTag->delete()) {
			$this->Session->setFlash(__('The menu tag has been deleted.'));
		} else {
			$this->Session->setFlash(__('The menu tag could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
