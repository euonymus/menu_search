<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
  public $image_upload = FALSE;

  /*************************************************************************/
  /* Reserved functions                                                    */
  /*************************************************************************/
  public function beforeValidate($options = array()) {
    // Exec only if $this->image_upload on the Model has been set to TRUE.
    if ($this->image_upload) {
      // $this->data[__CLASS__]['image_file']を優先する。['image']が入力されてても上書き更新する。
      if($this->hasUploadedImage()) {
	$this->data[$this->name]['image'] = $this->getImageFilePath(FALSE);
      }
    }
    return TRUE;
  }

  public function beforeSave($options = array()) {
    // Exec only if $this->image_upload on the Model has been set to TRUE.
    if ($this->image_upload) {
      // Only if it's updating, delete image files
      if(!empty($this->data[$this->name]['id'])) $this->id = $this->data[$this->name]['id'];
      if( !empty($this->id) ) {
	$this->deleteImgs($this->id, TRUE);
      }

      // Take care of image
      if($this->hasUploadedImage()) {
	if (!$this->saveUploadedImgs()) {
	  return false;
	}
      }
    }
    return TRUE;
  }

  public function afterFind($results, $primary = false) {
    // Exec only if $this->image_upload on the Model has been set to TRUE.
    if ($this->image_upload) {
      // Add thumbnail field if image field exists.
      if (array_key_exists($this->name, $results)) {
	$results = $this->addThumbField($result);
      } else {
	foreach($results as $key => $result) {
	  $results[$key] = $this->addThumbField($result);
	}
      }
    }
    return $results;
  }

  /*************************************************************************/
  /* Image Config                                                          */
  /*************************************************************************/
  // Transform original path to thumbnail path
  public static function toThumbPath($path) {
    $reg="/(.*)(?:\.([^.]+$))/";
    preg_match($reg,$path,$retArr);
    //echo "$retArr[0]"."\n<br/>";// /hoge/hoge.jpg
    //echo "$retArr[1]"."\n<br/>";// /hoge/hoge
    //echo "$retArr[2]"."\n<br/>";// jpg
    return $retArr[1].'_thumb.'.$retArr[2];
  }

  public function addThumbField($data) {
    if (array_key_exists($this->name, $data)) {
      $withModel = true;
      $work = $data[$this->name];
    } else {
      $withModel = false;
      $work = $data;
    }
    $imgPath = $this->imageField($work);
    if (!empty($imgPath)) $work['thumbnail'] = self::toThumbPath($imgPath);

    if ($withModel) {
      $data[$this->name] = $work;
    } else {
      $data = $work;
    }
    return $data;
  }
  public function imageField($data) {
    if (array_key_exists($this->name, $data)) $data = $data[$this->name];
    if (!array_key_exists('image', $data)) return NULL;
    return $data['image'];
  }

  /*************************************************************************/
  /* Care for Uploaded Image File                                          */
  /*************************************************************************/
  public static $image_path = '/uploaded/'; // It's a web path
  public static $image_filename = NULL;

  public $image_width = 800;
  public $image_height = 800;

  public function hasUploadedImage() {
    /*
      UPLOAD_ERR_OK
      Value: 0; There is no error, the file uploaded with success.

      UPLOAD_ERR_INI_SIZE
      Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.

      UPLOAD_ERR_FORM_SIZE
      Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.

      UPLOAD_ERR_PARTIAL
      Value: 3; The uploaded file was only partially uploaded.

      UPLOAD_ERR_NO_FILE
      Value: 4; No file was uploaded.

      UPLOAD_ERR_NO_TMP_DIR
      Value: 6; Missing a temporary folder. Introduced in PHP 5.0.3.

      UPLOAD_ERR_CANT_WRITE
      Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.

      UPLOAD_ERR_EXTENSION
      Value: 8; A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help. Introduced in PHP 5.2.0.
    */
    return (isset($this->data['NoModel']['image_file']['error']) && ($this->data['NoModel']['image_file']['error'] == UPLOAD_ERR_OK) );
  }

  public function saveUploadedImgs() {
    // MEMO: Generate folder before move_uploaded_file(), if it doesn't exist.
    $dir = dirname($this->getImageFilePath());
    App::uses('Folder', 'Utility');
    $folder = new Folder($dir, TRUE, 0777);

    App::uses('File', 'Utility');
    // TODO: 何故か権限が777にならないけど一旦無視
    $file = new File($this->getImageFilePath(), TRUE, 0777);
    if (!move_uploaded_file($this->data['NoModel']['image_file']['tmp_name'],$this->getImageFilePath())) return FALSE;

    if (isset($this->data['NoModel']['cropType'])) $fromCenter = !!($this->data['NoModel']['cropType']);
    else $fromCenter = true;

    // Memo: Build thumbnail
    $thumb = self::toThumbPath($this->getImageFilePath());
    copy($this->getImageFilePath(), $thumb);
    // Generate thumbnail file
    if (!$this->cropImage($thumb, $fromCenter, $this->image_width, $this->image_height)) return FALSE;
    return TRUE;
  }

  /**
   *  form post dataからサーバー上に保存するファイル名を作成する。
   */
  public function getImageFilePath($dirpath = TRUE) {
    $path = '/img'.self::$image_path;

    $filename = self::generateImageFilename($this->data['NoModel']['image_file']['name']);
    $date_dir     = date('Ymd', time());
    $ret = $path . $date_dir . '/' . $filename;

    if ($dirpath) $ret = self::toDirPath($ret);
    return $ret;
  }

  public function deleteImgs($id, $asUpdate = TRUE) {
    $oldimage = $this->find('first', array('fields' => array('image'), 'conditions' => array($this->name.'.id' => $id)));
    if (empty($oldimage)) return FALSE;

    // care for image field
    if (!$asUpdate ||
    	(isset($this->data[$this->name]['image']) && ($oldimage[$this->name]['image'] !== $this->data[$this->name]['image']))) {
      $imgPath = $oldimage[$this->name]['image'];
      self::deleteImg($imgPath);
      self::deleteImg(self::toThumbPath($imgPath));
    }
    return TRUE;
  }

  public static function generateImageFilename($image_filename) {
    if (is_null(self::$image_filename)) {
      self::$image_filename
	= self::getStem($image_filename)
	. self::generateRandomeNum()
	. self::getExtension($image_filename);
    }
    return self::$image_filename;
  }

  /**
   *  Generate a randome number
   */
  public static function generateRandomeNum() {
    return time().rand(1,10000);
  }

  /**
   *  Return the stem part in a path
   */
  public static function getStem($path) {
    $basename = basename($path);
    $lastDotInBaseName = strrpos($basename, '.');
    if ($lastDotInBaseName === FALSE) return $path;

    $lastDotPos = strrpos($path, '.');
    return substr($path, 0, $lastDotPos);
  }

  /**
   *  Return the extension in a path
   */
  public static function getExtension($path) {
    $basename = basename($path);
    $lastDotPos = strrpos($basename, '.');
    if ($lastDotPos === FALSE) return '';
    return substr($basename, $lastDotPos);
  }

  public static function toDirPath($path) {
    foreach(explode('/',$path) as $key => $val) {
      if ($key == 0) continue;
      if ($key == 1) $ret = WWW_ROOT . $val;
      else $ret .= DS . $val;
    }
    return $ret;
  }

  public static function deleteImg($image) {
    if (!self::isLocalImage($image)) return false;
    $image_path = self::toDirPath($image);
    @unlink($image_path);
    return true;
  }

  /**
   * Check if the image is under /img/
   */
  public static function isLocalImage($url) {
    if (!is_string($url) || empty($url)) return false;
    $basepath = str_replace('/', '\/', '/img'.self::$image_path);
    return !!preg_match("/^" . $basepath . ".+?/", $url);
  }

  function cropImage($imgPath, $fromCenter = true, $width, $height) {
    // Use PhpThumbFactory to manage image file
    App::import('Vendor', 'PhpThumbFactory', array('file'=>'phpthumb/ThumbLib.inc.php'));
    try {
      $thumb = PhpThumbFactory::create($imgPath);
    } catch (Exception $e) {
      LogTool::error('Failed to create PhpThumbFactory. imgPath:'. $imgPath);
    }

    try {
      // MEMO: PhpThumbFactoryの仕様でresizeUp=trueとしておくと、resizeターゲットより小さくても拡大してサイズを合わせられる。
      $thumb->setOptions(array('resizeUp' => true));
      if ($fromCenter) { // MEMO: adaptiveResizeはセンターからのリサイズしかできない。
      	$thumb->adaptiveResize($width, $height);
      } else { // MEMO: 0,0ポイントからリサイズしたい場合は、先に横 $width pxにしてからcropする。
      	$dimensions = $thumb->getCurrentDimensions();
      	$tangent = self::tangent($dimensions['width'], $dimensions['height']);
      	$thumbTangent = self::thumbTangent($width, $height);
      	if ($thumbTangent > $tangent) { // 規格の16:9と比べて横長の場合
      	  // 規格の16:9と比べて横長であり、横長の画像の場合
      	  if ($tangent <= 1) $resizeTo = round($height / $tangent);
      	  // 規格の16:9と比べて横長だが、縦長の画像の場合（注：16:9の場合ありえない）
      	  else $resizeTo = $height;
      	} else { // 規格の16:9と比べて縦長の場合
      	  // 規格の16:9と比べて縦長のだが、横長の画像の場合
      	  if ($tangent <= 1) $resizeTo = $width;
      	  // 規格の16:9と比べて縦長であり、縦長の画像の場合
      	  else $resizeTo = round($width * $tangent);
      	}
      	$thumb->resize($resizeTo, $resizeTo);
      	$thumb->crop(0, 0, $width, $height);
      }

      /* $thumb->resize(100, 100); */
      /* $thumb->adaptiveResize(150, 84); */
      /* $thumb->resizePercent(50); */
      /* $thumb->cropFromCenter(200, 100); */
      /* $thumb->cropFromCenter(200); */
      /* $thumb->crop(100, 100, 300, 200); */
      /* $thumb->rotateImage('CW'); */
      /* $thumb->rotateImageNDegrees(180); */

      $ret = $thumb->save($imgPath);
    } catch (Exception $e) {
      LogTool::error('Failed to write thumbnail file. thumbPath:'. $thumbPath);
      return false;
    }
    return TRUE;
  }

  public static function thumbTangent($width, $height) {
    return self::tangent($width, $height);
  }

  public static function tangent($sbj_len, $obj_len) {
    return round(($obj_len / $sbj_len), 5);
  }




  /*************************************************************************/
  /* Tools                                                                 */
  /*************************************************************************/
  public function loadModel($model) {
    if (!isset($this->{$model})) $this->{$model} = ClassRegistry::init($model);
  }
}
