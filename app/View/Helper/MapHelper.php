<?php
class MapHelper extends AppHelper {
  public $helpers = array('Html', 'Form');
  static $gmap = false;

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function mapIfExists() {
    return $this->_View->element('map', array('showAlways' => false));
  }

  public function map($asInput = false, $model = false) {
    return $this->_View->element('map', array('asInput' => $asInput, 'model' => $model));
  }
  public function updateLocation() {
    return $this->_View->element('js_location');
  }
  public function place() {
    return $this->_View->element('js_place');
  }

  public function initGmapLib($withPlace = false) {
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
      $attribute = array();
      if ($hasPosition) $attribute = compact('latitude', 'longitude');
      if ($withPlace) $attribute['withPlace'] = true;
      $this->gmap = $this->_View->element('js_map', $attribute);
      echo $this->gmap;
    }
    return $hasPosition;
  }


}
