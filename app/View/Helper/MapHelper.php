<?php
class MapHelper extends AppHelper {
  public $helpers = array('Html', 'Form');
  static $gmap = false;

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function initGmapLib() {
    $position = false;
    // If mapInit exists
    if (isset($this->_View->viewVars['mapInit'])) {
      $position = $this->_View->viewVars['mapInit'];
    }
    // Initialization
    $hasPosition = false;
    if (is_array($position) && U::notEmpty('latitude', $position) && U::notEmpty('longitude', $position)) {
      $hasPosition = true;
      $latitude = $position['latitude'];
      $longitude = $position['longitude'];
    }
    // Read Javascripts and render only once.
    if ($this->gmap == false) {
      if ($hasPosition) $this->gmap = $this->_View->element('js_map', compact('latitude', 'longitude'));
      else $this->gmap = $this->_View->element('js_map');
      echo $this->gmap;
    }
    return $hasPosition;
  }

  public function updateLocation() {
    echo $this->_View->element('js_location');
  }

  public function map($data, $asInput = false) {
    if ($asInput) {
      echo $this->_View->element('map', array('asInput'=>true));
    } elseif (isset($data['latitude']) && isset($data['longitude'])) {
      echo $this->_View->element('map');
    }
  }
}
