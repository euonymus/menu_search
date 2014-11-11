<?php
App::uses('AppController', 'Controller');
/**
 * Words Controller
 *
 * @property Word $Word
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WordsController extends AppController {
  public $layout = 'euonymus';

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
		$this->Word->recursive = 0;
		$this->set('words', $this->Paginator->paginate());
	}


	public function relation($word = false) {
	  if (!$word) $this->redirect(array('action' => 'index'));

	  $this->loadModel('Word');
	  $this->_loadComponent('PeriodTool');
	  $this->PeriodTool->setPeriod();

	  if ($this->pointTime) {
	    $word = $this->Word->findByWordAtPeriod($word, $this->pointTime);
	  } else {
	    $word = $this->Word->findByWordInPeriod($word, $this->startDate, $this->endDate);
	  }
	  $this->set(compact('word'));
	}



/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Word->exists($id)) {
			throw new NotFoundException(__('Invalid word'));
		}
		$options = array('conditions' => array('Word.' . $this->Word->primaryKey => $id));
		$this->set('word', $this->Word->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Word->create();
			if ($this->Word->save($this->request->data)) {
				$this->Session->setFlash(__('The word has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The word could not be saved. Please, try again.'));
			}
		}
		$relateds = $this->Word->Related->find('list');
		$this->set(compact('relateds'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Word->exists($id)) {
			throw new NotFoundException(__('Invalid word'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Word->save($this->request->data)) {
				$this->Session->setFlash(__('The word has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The word could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Word.' . $this->Word->primaryKey => $id));
			$this->request->data = $this->Word->find('first', $options);
		}
		$relateds = $this->Word->Related->find('list');
		$this->set(compact('relateds'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Word->id = $id;
		if (!$this->Word->exists()) {
			throw new NotFoundException(__('Invalid word'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Word->delete()) {
			$this->Session->setFlash(__('The word has been deleted.'));
		} else {
			$this->Session->setFlash(__('The word could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
