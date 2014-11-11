<?php
App::uses('Component', 'Controller');
class PeriodToolComponent extends Component {
  public $components = array('ParamTool');

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
  }

  /************************************************************************/
  /* named                                                                */
  /************************************************************************/
  public function setPeriod() {
    $this->Controller->pointTime = $this->setPointtime();
    if ($this->Controller->pointTime) return true;
    $this->setStartEndDate();
  }
  public function setPointtime() {
    return $this->ParamTool->named_init('pointtime');
  }
  public function setStartEndDate() {
    $startdate = $this->ParamTool->named_init('startdate');
    $enddate = $this->ParamTool->named_init('enddate');
    $this->Controller->startDate = $startdate ? $this->Controller->startDate = date('Y-m-d', strtotime($startdate)) : NULL;
    $this->Controller->endDate = $enddate ? $this->Controller->endDate = date('Y-m-d', strtotime($enddate)) : NULL;
  }

  /************************************************************************/
  /* pass                                                                 */
  /************************************************************************/
  /************************************************************************/
  /* tools                                                                */
  /************************************************************************/
}
