<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  public $layout = 'menu';
  public $components = array('DebugKit.Toolbar');
  public $helpers = array('U');

  public function beforeFilter() {
    $this->isSmartphone = $this->_isSmartphone();
    if ($this->isSmartphone) $this->theme = 'Smartphone';
  }

  /**************************************************************************************/
  /* Detect Agent                                                                       */
  /**************************************************************************************/
  public function _isSmartphone() {
    return ($this->_isIphone() || $this->_isAndroid());
  }

  public function _isIphone() {
    return (stripos(env('HTTP_USER_AGENT'),'iPhone') !== FALSE);
  }

  public function _isAndroid() {
    return (stripos(env('HTTP_USER_AGENT'),'Android') !== FALSE);
  }

  /**************************************************************************************/
  /* Data finder                                                                        */
  /**************************************************************************************/
  // general data getter
  public function _getModelsList($Model, $options = array(), $isPaging = false) {
    $this->loadModel($Model);
    if (isset($isPaging) && $isPaging) {
      if (!isset($options['limit']) || !is_numeric($options['limit'])) $options['limit'] = 20;
      // paginate
      $this->paginate = array($Model => $options);
      $data = $this->paginate($Model);
    } else {
      if (!isset($options['limit']) || !is_numeric($options['limit'])) $options['limit'] = 5;
      // TODO: ini_set('memory_limit', '256M');
      $data = $this->{$Model}->find('all', $options);
    }
    return $data;
  }

  /**************************************************************************************/
  /* Tools                                                                              */
  /**************************************************************************************/
  function _loadComponent($Component) {
    $this->{$Component} = $this->Components->load($Component);
    $this->{$Component}->initialize($this);
  }

  function _setFlash($string, $error = FALSE) {
	$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.$string,
				 'default', array('class' => 'alert alert-'. ($error ? 'danger' : 'success'))); 
  }
}
