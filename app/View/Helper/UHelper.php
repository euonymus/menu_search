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

  public function addActive($qualifieds) {
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

  /*****************************************************************************/
  /* Pict gram                                                                 */
  /*****************************************************************************/
  public static function pictgram($type, $font_size = '20pt') {
    return '<i class="' . $type . '" style="font-size: '. $font_size .';"></i>';
  }
  public static function pictHome($font_size = '20pt') {
    return self::pictgram("mdi-action-home", $font_size);
  }
  public static function pictRestaurant($font_size = '20pt') {
    return self::pictgram("mdi-maps-store-mall-directory", $font_size);
  }
  public static function pictRestaurantMenu($font_size = '20pt') {
    return self::pictgram("mdi-maps-restaurant-menu", $font_size);
  }
  public static function pictPlace($font_size = '20pt') {
    return self::pictgram("mdi-maps-place", $font_size);
  }
  public static function pictCompany($font_size = '20pt') {
    return self::pictgram("mdi-communication-business", $font_size);
  }
  public static function pictList($font_size = '20pt') {
    return self::pictgram("mdi-navigation-menu", $font_size);
  }
  public static function pictAddList($font_size = '20pt') {
    return self::pictgram("mdi-av-playlist-add", $font_size);
  }
  public static function pictSettings($font_size = '20pt') {
    return self::pictgram("mdi-action-settings", $font_size);
  }
  public static function pictContentSort($font_size = '20pt') {
    return self::pictgram("mdi-content-sort", $font_size);
  }
  public static function pictGlobe($font_size = '20pt') {
    return self::pictgram("mdi-social-public", $font_size);
  }
  public static function pictMoney($font_size = '20pt') {
    return self::pictgram("mdi-editor-attach-money", $font_size);
  }
  public static function pictSector($font_size = '20pt') {
    return self::pictgram("mdi-navigation-apps", $font_size);
  }
  public static function pictTrendingUp($font_size = '20pt') {
    return self::pictgram("mdi-action-trending-up", $font_size);
  }
  public static function pictPeople($font_size = '20pt') {
    return self::pictgram("mdi-social-people", $font_size);
  }
  public static function pictStockType($font_size = '20pt') {
    return self::pictgram("mdi-action-credit-card", $font_size);
  }
  public static function pictStar($font_size = '20pt') {
    return self::pictgram("mdi-action-grade", $font_size);
  }
  public static function pictMypage($font_size = '20pt') {
    return self::pictgram("mdi-action-account-circle", $font_size);
  }
  public static function pictAssignment($font_size = '20pt') {
    return self::pictgram("mdi-action-assignment", $font_size);
  }
  public static function pictLockOpen($font_size = '20pt') {
    return self::pictgram("mdi-action-lock-open", $font_size);
  }
  public static function pictKey($font_size = '20pt') {
    return self::pictgram("mdi-communication-vpn-key", $font_size);
  }
}
