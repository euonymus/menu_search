<?php
class MenuHelper extends AppHelper {
  public $helpers = array('Html', 'Form');

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function linkTags($tags, $label = false) {
    if (!$label) $label = $tags;
    $tagList = explode(',', $tags);
    $tagList = implode(',', array_map('urlencode', $tagList));
    return $this->Html->link($label, '/menus/categories/?tags='. $tagList);
  }

  public function linkStation($station_id, $label, $options = array()) {
    if (array_key_exists('isRestaurant', $options)) $isRestaurant = $options['isRestaurant'];
    else $isRestaurant = false;

    if ($isRestaurant) {
      $path = '/restaurants/';
    } else {
      $path = '/menus/region/';
    }
    $query_station = MenuToolComponent::SESSION_STATION.'=' . $station_id;
    $linkAction = $path . '?' . $query_station;

    return $this->Html->link($label, $linkAction, $options);
  }

  public static function stars($point) {
    $ret = '';
    $ret = UHelper::pictStar('16pt', 'lime');

    if ($point > 5) {
      $ret .= UHelper::pictStar('16pt', 'lime');
    }
    if ($point > 10) {
      $ret .= UHelper::pictStar('16pt', 'lime');
    }
    if ($point > 15) {
      $ret .= UHelper::pictStar('16pt', 'lime');
    }
    if ($point > 20) {
      $ret .= UHelper::pictStar('16pt', 'lime');
    }
    return $ret;
  }

  public function searchTitle() {
    $station = $this->_View->viewVars['station'];
    $tags = $this->_View->viewVars['tags'];
    $currentGeo = $this->_View->viewVars['currentGeo'];

    $res = '';
    if ($station) $res .= $station.'駅周辺の';
    elseif ($currentGeo) {
      $res .= '周辺の';
    }
    if ($tags) $res .= $tags;
    else $res .= 'メニュー';
    $res .= '<br><small>検索結果</small>';

    return $res;
  }
}
