<?php
App::uses('ModelBehavior', 'Model');
class TaggableBehavior extends ModelBehavior {

  const DELIMITER = ',';
  /* static $WordPattern; */
  static $ngPatternList;
  var $allow_space = false;

  public function setup(Model $model, $config = array()) {
  }

  public function getAllowSpace() {
    return $this->allow_space;
  }
  
  public function allowSpaceInTag(Model $model, $allow_space = true) {
    $this->allow_space = $allow_space;
  }

  public function strip(Model $model, $str) {
    $str = mb_convert_kana($str, 's');
    $str = str_replace('、', ',', $str);
    $str = str_replace('，', ',', $str);
    if($this->allow_space){
      $str = preg_replace('|,[ ]+|', ',', $str);
      $str = preg_replace('|[ ]+,|', ',', $str);
      $str = preg_replace('|[,]+|', ',', $str);
      $str = preg_replace('| +|', ' ', $str);
    } else {
      $str = preg_replace('|[, ]+|', ',', $str);
    }
    $str = trim($str, ',');
    $str = preg_replace('|<script>.*</\s*script>|', '', $str);
    $str = strip_tags($str);
    if($this->allow_space){
      $str = preg_replace('|,[ ]+|', ',', $str);
      $str = preg_replace('|[ ]+,|', ',', $str);
      $str = preg_replace('|[,]+|', ',', $str);
      $str = preg_replace('| +|', ' ', $str);
    } else {
      $str = preg_replace('|[, ]+|', ',', $str);
    }
    $str = trim($str, ',');
    return $str;
  }

  public function getTagList(Model $model, $data, $isHashtag = false) {
    if (is_string($data)) {
      $data = $this->strip($model, $data);
      $data = explode(self::DELIMITER, $data);
    }

    $ret = array();
    if (is_array($data)) {
      foreach ($data as $d) {
        /* if (strlen($d) && $this->isOk($model, $d)) { */
        if (strlen($d)) {
          if ($isHashtag && $d[0] !== '#') {
            $d = '#' . $d;
          }

          if (!in_array($d, $ret)) {
            $ret[] = $d;
          }
        }
      }
    }

    return $ret;
  }

  public function getTagFormValue(Model $model, $data, $isHashtag = false) {
    if (is_string($data)) {
      $data = $this->getTagList($model, $data, $isHashtag);
    }

    $ret = '';
    if (is_array($data)) {
      $ret = implode(self::DELIMITER, $data);
    }

    return $ret;
  }

  public function getTagFieldValue(Model $model, $data, $isHashtag = false) {
    return self::DELIMITER
      . $this->getTagFormValue($model, $data, $isHashtag)
      . self::DELIMITER;
  }

  public function getTagSearchToken(Model $model, $tag) {
    return '%'
      . str_replace('%', '\%', $this->getTagFieldValue($model, $tag))
      . '%';
  }

  public function getWildSearchToken(Model $model, $tag) {
    return '%'
      . str_replace('%', '\%', $this->getTagFormValue($model, $tag))
      . '%';
  }

  /* function isOk(Model $model, $tag) { */
  /*   return !$this->isNg($model, $tag); */
  /* } */

  /* function isNg(Model $model, $tag) { */
  /*   if (!self::$WordPattern) { */
  /*     self::$WordPattern =& ClassRegistry::init('WordPattern'); */
  /*   } */

  /*   return self::$WordPattern->isNg($tag); */
  /* } */

}
