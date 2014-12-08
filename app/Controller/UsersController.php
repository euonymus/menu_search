<?php 
class UsersController extends AppController {
  public $components = array('Session');

  const SESSION_LOGIN         = 'Login';
  const SESSION_CALLBACK_PATH = 'UserCallbackPath';

  public $childModel = FALSE;

  public function beforeFilter() {
    parent::beforeFilter();
    /* $this->Auth->allow('add', 'oplogin', 'logout', 'opauth_complete'); */
    $this->Auth->deny('index', 'password', 'unregist');
  }

  /*
  public function index() {
    $this->User->recursive = 0;
    $this->set('users', $this->paginate());
  }
  */

  public function add() {
    if ($this->Auth->loggedIn()) $this->redirect('/');

    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->User->save($this->request->data)) {
	$this->_setFlash(__('アカウントが登録されました。'));
	$this->login();
      } else {
	$this->_setFlash(__('アカウント登録に失敗しました。'), TRUE);
      }
    } else {
      $callback_path = $this->_callbackPath();
      $this->Session->write('Auth.redirect', $callback_path);
    }
  }
  
  public function oplogin($provider) {
    $callback_path = $this->_callbackPath();
    $this->Session->write(self::SESSION_CALLBACK_PATH, $callback_path);
    $this->redirect(array('controller' => 'auth', 'action' => $provider));
  }

  public function login() {
    if ($this->Auth->loggedIn()) $this->redirect('/');

    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
	$this->redirect($this->Auth->redirect());
      } else {
	$this->_setFlash(__('ログインに失敗しました。'), TRUE);
      }
    } else {
      $callback_path = $this->_callbackPath();
      $this->Session->write('Auth.redirect', $callback_path);
    }
  }

  public function logout() {
    $this->redirect($this->Auth->logout());
  }
  
  public function password() {
    $this->_edit($this->currentUser['id']);
  }

  public function unregist() {
    $this->_delete($this->currentUser['id']);
  }

  public function opauth_complete() {
    $this->_callbackPreparation();

    if ($this->Auth->loggedIn()) {
      // If loggedin, it generates relation btw auth and opauth
      $saved = $this->{$this->childModel}->createRelation($this->currentUser['username'], $this->request->data['auth']);
    } else {
      // If not loggedin, it's a normal login or generating new account
      $saved = $this->{$this->childModel}->saveOpauth($this->request->data['auth']);
      if ($saved) $this->Auth->login($saved['User']);
    }
    /* pr($this->{$this->childModel}->validationErrors); */
    if ($saved) {
      $this->Session->delete(self::SESSION_LOGIN);
      $this->Session->delete(self::SESSION_CALLBACK_PATH);
      $this->redirect($this->callback_path);
    }

    if (isset($this->{$this->childModel}->validationErrors['opauth'])
	&& in_array('noemail', $this->{$this->childModel}->validationErrors['opauth'])) {
      $this->Session->write(self::SESSION_LOGIN, $this->request->data['auth']);
    }
  }

  function _loadChildModel() {
    $this->childModel = $this->User->getChildModel($this->request->data['auth']['provider']);
    if (!$this->childModel) $this->_errorRedirect();
    $this->loadModel($this->childModel);
  }

  function _callbackPreparation() {
    // Needs preparation, if it's manual post
    if ($this->request->is('post') && isset($this->request->data['User'])) {
      $auth = $this->Session->read(self::SESSION_LOGIN);
      if (empty($auth)) $this->_errorRedirect();
      $auth['info']['email'] = $this->request->data['User']['username'];
      $this->request->data['auth'] = $auth;
    }

    $this->_callbackConditionCheck();
    $this->_loadChildModel();

    $this->callback_path = $this->Session->read(self::SESSION_CALLBACK_PATH);
  }

  function _callbackConditionCheck() {
    if ($this->_isDenied() || empty($this->request->data)) $this->_errorRedirect();
  }

  function _callbackPath() {
    if (isset($this->request->query['location'])) {
      $callback_path = $this->request->query['location'];
    } else {
      $callback_path = '/';
    }
    return $callback_path;
  }

  function _isDenied() {
    if (isset($this->request->data['error']) && ($this->request->data['error']['code'] == 'access_denied')) return TRUE;
    return FALSE;
  }

  private function _edit($id = null) {
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    if ($this->request->is('post') || $this->request->is('put')) {
      if ($this->User->save($this->request->data)) {
  	$this->Session->setFlash(__('The user has been saved'));
  	$this->redirect(array('action' => 'index'));
      } else {
  	$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
      }
    } else {
      $this->request->data = $this->User->read(null, $id);
      unset($this->request->data['User']['password']);
    }
  }

  private function _delete($id = null) {
    if (!$this->request->is('post')) {
      throw new MethodNotAllowedException();
    }
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->User->bindAllChild(FALSE);
    if ($this->User->delete()) {
      $this->Session->setFlash(__('User deleted'));
      /* $this->redirect(array('action' => 'index')); */
      $this->redirect($this->Auth->logout());
    }
    $this->Session->setFlash(__('User was not deleted'));
    $this->redirect(array('action' => 'index'));
  }

}