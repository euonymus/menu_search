<?php
App::uses('Component', 'Controller');
class StationToolComponent extends Component {
  public $components = array('ParamTool');

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
  }

  /************************************************************************/
  /* Data finder                                                          */
  /************************************************************************/
  public function setStationName() {
    $station_id = $this->ParamTool->query_init('station_id');
    $this->Controller->loadModel('Station');
    $station = $this->Controller->Station->findById($station_id);
    $station = empty($station) ? '' : $station['Station']['name'];
    $this->Controller->set(compact('station'));
  }

  /************************************************************************/
  /* Validation                                                           */
  /************************************************************************/
  /************************************************************************/
  /* Tools                                                                */
  /************************************************************************/
}
