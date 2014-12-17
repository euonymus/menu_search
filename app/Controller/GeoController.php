<?php
App::uses('AppController', 'Controller');
class GeoController extends AppController {
  public $components = array('Session', 'RequestHandler');

  // get geo info from browser and save it to session and redirect
  public function init() {
    $this->_loadComponent('ParamTool');
    $location = $this->ParamTool->query_init('location');

    $this->_loadComponent('GeoTool');
    if ($this->GeoTool->needToGetFromBrowser(true)) {
      // セッション内のtimestampが1時間以上経過している場合新たにブラウザからgeo情報を取得する。
      $this->set(compact('location'));
    } else {
      // セッション内のtimestampが1時間以内の場合そのまま利用する
      $this->redirect($location);
    }
  }

  /******************************************************************/
  /* API                                                            */
  /******************************************************************/
  /*
  static $testData = array(
			   'timestamp' => 1518574049079,
			   'coords' => array(
					     'speed' => '',
					     'heading' => '',
					     'altitudeAccuracy' => '',
					     'accuracy' => 33,
					     'altitude' => '',
					     'latitude' => '35.64418424015282',
					     'longitude' => '139.69862937927246',
					     )
			   );
  */
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
