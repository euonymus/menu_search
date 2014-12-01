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

    $querys = $this->params['url'];
    $query_station = array_key_exists('station', $querys) ? '&station=' . $querys['station'] : '';

    return $this->Html->link($label, '/menus/?tags='. $tagList . $query_station);
  }

  public function linkStation($station_id, $label, $options = array()) {
    if (array_key_exists('isRestaurant', $options)) $isRestaurant = $options['isRestaurant'];
    else $isRestaurant = false;

    $querys = $this->params['url'];
    $tags = array_key_exists('tags', $querys) ? $querys['tags'] : false;
    $skip_tags = array_key_exists('skip_tags', $querys) ? $querys['skip_tags'] : false;

    $query_tags = '';
    if ($isRestaurant) {
      $path = '/restaurants/';
    } elseif ($tags || $skip_tags) {
      $path = '/menus/';
      $query_tags = $tags ? 'tags=' . $tags . '&' : '';
    } else {
      $path = '/menus/categories/';
    }
    $query_station = 'station=' . $station_id;
    $linkAction = $path . '?' . $query_tags . $query_station;

    return $this->Html->link($label, $linkAction, $options);
  }
}
