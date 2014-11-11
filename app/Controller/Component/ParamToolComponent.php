<?php
App::uses('Component', 'Controller');
class ParamToolComponent extends Component {
  public function initialize(Controller $controller) {
    $this->Controller = $controller;
  }

  /************************************************************************/
  /* named                                                                */
  /************************************************************************/
  public function setStartEndDate($startDefault = false, $endDefault = false) {
    $startDefault = U::day1();
    $this->Controller->startDate = date('Y-m-d', strtotime($this->named_init('startdate', $startDefault)));

    $endDefault = date('Y-m-d', time());
    $this->Controller->endDate = date('Y-m-d', strtotime($this->named_init('enddate', $endDefault)));
  }
  public function named_init($named, $default = false) {
    return $this->named_exists($named) ? $this->Controller->params['named'][$named] : $default;
  }

  public function named_exists($named) {
    return array_key_exists($named, $this->Controller->params['named']);
  }

  /************************************************************************/
  /* pass                                                                 */
  /************************************************************************/
  public function query_init($query, $default = false) {
    return $this->query_exists($query) ? $this->Controller->params->query[$query] : $default;
  }

  public function query_exists($query) {
    return array_key_exists($query, $this->Controller->params->query);
  }

  /************************************************************************/
  /* tools                                                                */
  /************************************************************************/
}
