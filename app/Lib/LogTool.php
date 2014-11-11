<?php
/*
 * LogTool: The tools for logging
 *
 */
class LogTool extends Object {
  private static $instance = NULL;
  private $logCategory = NULL;

  static function setLogCategory($logCategory) {
    self::getInstance()->logCategory = $logCategory;
  }

  /**
   * This get an instance of this class
   *
   * @return an instance
   */  
  static function getInstance() {
    if (!self::$instance) {
      self::$instance = new LogTool();
    }
    return self::$instance;
  }

  /**
   * Initialize this instance to NULL
   */
  static function init() {
    self::$instance = NULL;
  }

  /**
   * Use this to write a log in error.log
   *
   * @param string $message The message that you want to show
   * @param string $category A category of the logging service
   * @param string $keyword The level of severity
   */
  static function error($message, $category = NULL, $keyword = 'ERROR') {
    if(is_null($category)) $category = self::getInstance()->logCategory;

    $message = self::_formatMessage($message);
    self::getInstance()->_error($message, $category, $keyword);
  }

  /**
   * Use this to write a log in debug.log
   *
   * @param string $message The message that you want to show
   * @param string $category A category of the logging service
   * @param string $keyword The level of severity
   */
  static function debug($message, $category = NULL, $keyword = '') {
    if(is_null($category)) $category = self::getInstance()->logCategory;

    $message = self::_formatMessage($message);
    self::getInstance()->_debug($message, $category, $keyword);
  }

  /**
   * Use this to write a log in User based file and format
   */
  static function user_log($message, $type = LOG_DEBUG) {
    self::getInstance()->_user_log($message, $type);
  }

  /**
   * Make $val to string without a breakcode
   *
   * @param mixed $val You can put any of String, Object and Array
   * @return string
   */
  static function formVal($val){
    $val = preg_replace("/[\r\n]/", '', print_r($val,true));
    return $val;
  }

  /**
   * error() calls this
   */
  protected function _error($message, $category = NULL, $keyword = 'ERROR') {
    $this->_log($message, $category, LOG_ERR, $keyword);
  }

  /**
   * debug() calls this
   */
  protected function _debug($message, $category = NULL, $keyword = '') {
    $this->_log($message, $category, LOG_DEBUG, $keyword);
  }

  /**
   * user_log() calls this
   */
  protected function _user_log($message, $type = LOG_DEBUG) {
    $this->log($message, $type);
  }

  /**
   * Write a log in a certain manner
   *
   * @param string $message The message that you want to show
   * @param string $category A category of the logging service
   * @param string The type of log
   * @param string $keyword The level of severity
   */
  protected function _log($message, $category = NULL, $type = LOG_DEBUG, $keyword = '') {
    if (!$category) {
      if (property_exists($this, 'logCategory')) {
        $category = $this->logCategory;
      }
    }

    if (strlen($category)) {
      $category = '[' . $category . ']';
    }
    else {
      $category = '';
    }

    if (strlen($keyword)) {
      $keyword = '[' . $keyword . ']';
    }
    else {
      $keyword = '';
    }

    if (strlen($category) || strlen($keyword)) {
      $message = $category . $keyword . ' ' . $message;
    }

    $this->log($message, $type);
  }

  /**
   * This sets errored method, file and line and return a string
   *
   * @param string $message
   */
  protected static function _formatMessage($message){
    $trace = debug_backtrace();

    if (!is_array($trace)) return $message;
    if (!isset($trace[0]) || !isset($trace[1])) return $message;
    if (!isset($trace[1]['file'])||!isset($trace[1]['line'])) return $message;

    $file = $trace[1]['file'];
    $line = $trace[1]['line'];
    
    if(isset($trace[2])&&isset($trace[2]['function'])){
      $class = (array_key_exists('class', $trace[2])?$trace[2]['class'].'::':'');
      $method = $class . $trace[2]['function'] . ',';
    } else {
      $method = '';
    }
      
    return $message . ': ' . $method . $file . ',' . $line;
  }
}
