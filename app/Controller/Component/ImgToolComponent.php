<?php
class ImgToolComponent extends Object {
  const MISSING_IMG_FILE = 'icon_nowprinting.png';

  var $filePath = false;

  function initialize(&$controller) {
    // Saving the controller reference for later use
    $this->controller =& $controller;
  }

  static function missingImgPath() {
    return APP . 'webroot/img/'.self::MISSING_IMG_FILE;
  }

  static function renderImage($filePath) {
    $mime = self::getMime($filePath);
    if ($mime === FALSE) return false;

    Configure::write('debug', 0);
    header('Content-type:' . $mime);
    echo  file_get_contents($filePath);
    return true;
  }

  static function getMime($path) {
    if (!is_file($path)) return false;
    $size = getimagesize($path);
    return $size['mime'];
  }

  static function retrieveImg($fromPath, $toPath) {
    // Get image file from the url
    $data = @file_get_contents($fromPath);
    if (!$data) {
      LogTool::error('Failed to get image file. image_path: ' . $fromPath);
      return false;
    }

    // create folder instance
    $file = new File($toPath, true, 0777);
    if (empty($file->path)) {
      LogTool::error('Failed to create dir. dir: ' . $toPath);
      return false;
    }
    return $file->write($data);
  }

  /****************************************************************************/
  /* Input configuration                                                      */
  /****************************************************************************/
  function buildFilePathFromInputInfo($pathOnWebroot = false) {
    if (!$pathOnWebroot) $pathOnWebroot = $this->controller->params['controller'];
    $path = $this->pathFromInputInfo();
    return APP . 'webroot/'.$pathOnWebroot.'/'.$path;
  }

  function transformPathToExtSiteDomain($extDomain) {
    $path = $this->pathFromInputInfo();
    return 'http://'.$extDomain.'/' . $path;
  }

  function pathFromInputInfo() {
    if ($this->filePath) return $this->filePath;
    $filePath = implode('/', $this->controller->params['pass']);
    if (!$filePath || strtolower(substr($filePath, 0, 3)) === '%3f') {
      header('HTTP/1.1 403 Forbidden');
      $this->controller->_stop();
    }
    $this->filePath = $filePath;
    return $filePath;
  }
}
