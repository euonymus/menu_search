<?php
class MenuHelper extends AppHelper {
  public $helpers = array('Html', 'Form');

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function menuByTags($tags, $label = false) {
    if (!$label) $label = $tags;
    $tagList = explode(',', $tags);
    $tagList = implode(',', array_map('urlencode', $tagList));

    $querys = $this->params['url'];
    $query_station = array_key_exists('station', $querys) ? '&station=' . $querys['station'] : '';

    return $this->Html->link($label, '/menus/search/?tags='. $tagList . $query_station);
  }

  public function menuByStation($station_id, $label, $options = false) {
    $querys = $this->params['url'];
    $query_tags = array_key_exists('tags', $querys) ? 'tags=' . $querys['tags'] . '&' : '';
    return $this->Html->link($label, '/menus/search/?'.$query_tags.'station='. $station_id, $options);
  }
}
