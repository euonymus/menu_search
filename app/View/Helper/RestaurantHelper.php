<?php
class RestaurantHelper extends AppHelper {
  public $helpers = array('Html', 'Form');

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function searchTitle() {
    $station = $this->_View->viewVars['station'];
    $currentGeo = $this->_View->viewVars['currentGeo'];

    $res = '';
    if ($station) $res .= $station.'駅周辺の';
    elseif ($currentGeo) {
      $res .= '周辺の';
    }
    $res .= 'レストラン';
    $res .= '<br><small>検索結果</small>';

    return $res;
  }
}
