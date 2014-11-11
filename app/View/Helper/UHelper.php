<?php
class UHelper extends AppHelper {
  public static $nav = array(
    'dgi'    => array('path' => '/dgi', 'show' => '社内', 'qualifieds' => array('dgi','admin')),
    'bengo4' => array('path' => '/bengo4', 'show' => '弁護士', 'qualifieds' => 'bengo4'),
  );

  public $helpers = array('Html', 'Form');

  static $conductor = false;

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function adActive($qualifieds) {
    return self::active($qualifieds) ? ' active' : '';
  }
  public function active($qualifieds) {
    if (is_string($qualifieds)) $qualifieds = array($qualifieds);
    if ($this->params['prefix'])  {
      $current = $this->params['prefix'];
    } else {
      $current = strtolower($this->_View->name);
    }
    return in_array($current, $qualifieds);
  }
  public static function currency($num, $symbol = false) {
    $res = ($symbol && is_string($symbol)) ? (($symbol == '\\') ? '&yen;' : $symbol) : '';
    $res .= number_format($num);
    return $res;
  }
  public static function rate($molecule, $denominator) {
    if (!$denominator) return '-';
    return round(($molecule / $denominator) * 100, 2) . '%';
  }
}
