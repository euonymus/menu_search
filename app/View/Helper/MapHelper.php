<?php
class MapHelper extends AppHelper {
  public $helpers = array('Html', 'Form');

  public function __construct(View $View, $settings = array()) {
    parent::__construct($View, $settings);
  }

  public function map($data, $asInput = false) {
    if ($asInput) {
      echo $this->_View->element('map', array('position' => $data, 'asInput'=>true));
    } elseif (isset($data['latitude']) && isset($data['longitude'])) {
      echo $this->_View->element('map', array('position' => $data));
    }
  }
}
