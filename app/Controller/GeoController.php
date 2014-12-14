<?php
App::uses('AppController', 'Controller');
class GeoController extends AppController {
  public $components = array('Session', 'RequestHandler');

  /******************************************************************/
  /* API                                                            */
  /******************************************************************/
  static $testData = array(
			   'timestamp' => 1518574049079,
			   'coords' => array(
					     'speed' => '',
					     'heading' => '',
					     'altitudeAccuracy' => '',
					     'accuracy' => 33,
					     'altitude' => '',
					     'longitude' => '139.68791059999998',
					     'latitude' => '35.6530333',
					     )
			   );

  public function update() {
    $this->set('data', 'stay');
    // MEMO: test
    //$this->request->data = self::$testData;
    if ($this->request->is('post')) {
        $updated =  $this->GeoTool->update($this->request->data);
	if ($updated) {
	  $this->set('data', 'saved');
	}
    }
    $this->set('_serialize', array('data'));
  }
}
