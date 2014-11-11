<?php
App::uses('ModelBehavior', 'Model');
class MasterBehavior extends ModelBehavior {
  public $orderOption = array('field' => 'order', 'direction' => 'ASC');

  public function setup(Model $Model, $settings = array()) {
  }

  public function getList(Model $Model, $field = false) {
    if (isset($Model->orderOption)) $order = $Model->orderOption;
    else $order = $this->orderOption;

    $options = array('order' => array($Model->name.'.'.$order['field'] => $order['direction']));
    $data = $Model->find('all', $options);
    if (empty($data)) return false;

    if (!$field) $field = 'name';
    $ret = array();
    foreach($data as $key => $val) {
      if (!array_key_exists($field, $val[$Model->name])) $field = 'name';
      $ret[$val[$Model->name]['id']] = $val[$Model->name][$field];
    }
    return $ret;
  }
}
