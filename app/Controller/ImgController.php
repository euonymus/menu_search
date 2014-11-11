<?php
class ImgController extends AppController {

  var $autoRender = FALSE;
  var $uses = array();

  function beforeFilter(){
    $this->renewSession = false;
    parent::beforeFilter();
  }

  function fetch() {
    $this->_loadComponent('ImgTool');
    // Prepare file path and mime type
    $filePath = $this->ImgTool->buildFilePathFromInputInfo();
    $mime = ImgToolComponent::getMime($filePath);
    if ($mime === FALSE) {
      // If the file does'nt exist, do something
      /* $orgnPath = $this->ImgTool->transformPathToExtSiteDomain('www.gizmodo.jp'); */
      /* $res = ImgToolComponent::retrieveImg($orgnPath, $filePath); */
      /* if (!$res) $filePath = ImgToolComponent::missingImgPath(); */
      $filePath = ImgToolComponent::missingImgPath();
    }
    $this->ImgTool->renderImage($filePath);
  }
}