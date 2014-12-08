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

  public function index() {
    $this->User->recursive = 0;
    $this->set('users', $this->paginate());
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->User->create();
      if ($this->User->save($this->request->data)) {
	$this->_setFlash(__('アカウントが登録されました。'));
	$this->login();
      } else {
	$this->_setFlash(__('アカウント登録に失敗しました。'), TRUE);
      }
    }
  }
  
  public function oplogin($provider) {
    $callback_path = $this->_callbackPath();
    $this->Session->write(self::SESSION_CALLBACK_PATH, $callback_path);
    $this->redirect(array('controller' => 'auth', 'action' => $provider));
  }

  public function login() {
    if ($this->Auth->loggedIn()) $this->redirect(array('action' => 'index'));

    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
	$this->redirect($this->Auth->redirect());
      } else {
	$this->_setFlash(__('ログインに失敗しました。'), TRUE);
      }
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

  /* public function view($id = null) { */
  /*   $this->User->id = $id; */
  /*   if (!$this->User->exists()) { */
  /*     throw new NotFoundException(__('Invalid user')); */
  /*   } */
  /*   $this->set('user', $this->User->read(null, $id)); */
  /* } */

// TODO: remove below later
  // Dummy array for facebook test
  var $data_fb = array(
   		     'auth' => array(
   				     'provider' => 'Facebook',
   				     'uid' => '628615341',
   				     'info' => array(
   						     'name' => 'Satoshi Mayumi',
   						     'image' => 'https://graph.facebook.com/628615341/picture?type=square',
   						     'email' => 'euonymus0220@gmail.com',
   						     'nickname' => 'satoshi.mayumi',
   						     'first_name' => 'Satoshi',
   						     'last_name' => 'Mayumi',
   						     'urls' => array(
   								     'facebook' => 'http://www.facebook.com/satoshi.mayumi'
   								     )
   						     ),
   				     'credentials' => array(
   							    'token' => 'CAACDq1bM1LkBAATzsFBEDG5roDa04BySHUGYFQniwCbqR9Tk3M7xs4fXbHU94Q7mkNEWP2nZBXqzd2zkRwoYKVot5qUVq1lAp3ZBWT32PZBkd5K4cl36ZBDlGymmN2YzolGStMxSA5mL9fp56p3d9I3BqDvAOwoZD',
   							    'expires' => '2013-07-19T18:54:27+09:00'
   							    ),
   				     'raw' => array(
   						    'id' => '628615341',
   						    'name' => 'Satoshi Mayumi',
   						    'first_name' => 'Satoshi',
   						    'last_name' => 'Mayumi',
   						    'link' => 'http://www.facebook.com/satoshi.mayumi',
   						    'username' => 'satoshi.mayumi',
   						    'hometown' => array(
   									'id' => '122526624486029',
   									'name' => 'Okazaki-shi, Aichi, Japan'
   									),
   						    'gender' => 'male',
   						    'email' => 'euonymus0220@gmail.com',
   						    'timezone' => 9,
   						    'locale' => 'en_US',
   						    'verified' => 1,
   						    'updated_time' => '2013-05-17T09:58:20+0000'
   						    )
   				     ),
   		     'timestamp' => '2013-05-20T18:54:35+09:00',
   		     'signature' => 'nr3q04gcqcgkw8g4w8ggkowg800w48g',
   		     'validated' => TRUE
   		     );

   // Dummy array for twitter test
  var $data_tw = array(
		     'auth' => array(
				     'provider' => 'Twitter',
				     'uid' => 14853254,
				     'info' => array(
						     'name' => 'さとし（ユオニマス）',
						     'nickname' => 'euonymus',
						     'urls' => array(
								     'twitter' => 'http://twitter.com/euonymus',
								     'website' => 'http://euonymus.info/'
								     ),
						     'location' => '東京都',
						     'description' => 'Web開発。【好き】イラスト・写真・一眼レフカメラ・旅行・ガンダム・動物・クジラ・宇宙・哲学【嫌い】優等生・予定調和・さくら（偽客）・無知の無知',
						     'image' => 'http://a0.twimg.com/profile_images/3241863246/48ca67cd15f43651f803e5620e60f05f_normal.png',
						     ),
				     'credentials' => array(
							    'token' => '14853254-0thsG9BOEAX061OBg5BPnEVYg7oxs3nZW0N3pUu8',
							    'secret' => 'PUIxw7YJZg0WdWMMXmGLA9t3nqxPX7rnSDGDabLY'
							    ),
				     'raw' => array(
				     		    'id' => 14853254,
				     		    'id_str' => '14853254',
				     		    'screen_name' => 'euonymus',
				     		    'name' => 'さとし（ユオニマス）',
				     		    'description' => 'Web開発。【好き】イラスト・写真・一眼レフカメラ・旅行・ガンダム・動物・クジラ・宇宙・哲学【嫌い】優等生・予定調和・さくら（偽客）・無知の無知',

				     		    'profile_image_url' => 'http://a0.twimg.com/profile_images/3241863246/48ca67cd15f43651f803e5620e60f05f_normal.png',
				     		    'profile_image_url_https' => 'https://si0.twimg.com/profile_images/3241863246/48ca67cd15f43651f803e5620e60f05f_normal.png',
				     		    'profile_background_image_url' => 'http://a0.twimg.com/profile_background_images/40008230/try11.jpg',
				     		    'profile_background_image_url_https' => 'https://si0.twimg.com/profile_background_images/40008230/try11.jpg',
				     		    'profile_use_background_image' => 1,

				     		    'profile_text_color' => '634047',
				     		    'profile_link_color' => '088253',
				     		    'profile_background_color' => 'FFFFFF',
				     		    'profile_sidebar_border_color' => 'DBBC5E',
				     		    'profile_sidebar_fill_color' => 'F5923B',

				     		    'url' => 'http://euonymus.info/',
				     		    'profile_banner_url' => 'https://si0.twimg.com/profile_banners/14853254/1363680990',

				     		    'protected' => 0,
				     		    'is_translator' => 0,
				     		    'verified' => 0,
				     		    'contributors_enabled' => 0,
				     		    'geo_enabled' => 1,

				     		    'follow_request_sent' => 0,
				     		    'profile_background_tile' => 0,

				     		    'location' => '東京都',
				     		    'lang' => 'ja',
				     		    'utc_offset' => 32400,
				     		    'time_zone' => 'Tokyo',

				     		    'followers_count' => 1160,
				     		    'friends_count' => 881,
				     		    'listed_count' => 70,
				     		    'favourites_count' => 13,
				     		    'statuses_count' => 4073,

				     		    'default_profile' => 0,
				     		    'default_profile_image' => 0,
				     		    'notifications' => 0,
				     		    'following' => 0,
				     		    'created_at' => 'Wed May 21 06:44:44 +0000 2008',
				     		    ),
				     ),
		     'timestamp' => '2013-05-20T10:19:16+00:00',
		     'signature' => '9p77luxzojk0004kcc4cw0s8gwgccgk',
		     'validated' => TRUE
		     );
}