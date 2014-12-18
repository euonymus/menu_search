<?php
App::uses('Component', 'Controller');
class GeoToolComponent extends Component {
  public $components = array('ParamTool');

  const SESSION_CURRENT_GEO = 'current_location';
  // ベータ版（サービス範囲限定の中心ポイントをdefaultとする
  const GEO_LATITUDE_DEFAULT = '35.64418424015282';
  const GEO_LONGITUDE_DEFAULT = '139.69862937927246';

  public function initialize(Controller $controller) {
    $this->Controller = $controller;
    $this->ParamTool->initialize($controller);
    $this->Controller->geo = false;
  }

  /************************************************************************/
  /* Data finder                                                          */
  /************************************************************************/
  public function read($return = false) {
    $geo = $this->Controller->Session->read(self::SESSION_CURRENT_GEO);
    if ($return) return $geo;
    $this->Controller->geo = $geo;
  }
  public function update($data) {
    // Delete existing session if expired.
    $existing = $this->read(true);
    if (is_array($existing) && array_key_exists('timestamp', $existing)) {
      if (self::hasExpired($existing['timestamp'])) {
	$this->Controller->Session->delete(self::SESSION_CURRENT_GEO);
      }
    }

    if ($this->needUpdate($data)) {
      $this->Controller->Session->write(self::SESSION_CURRENT_GEO, $data);
      return true;
    }
    return false;
  }
  /* 現在地をブラウザから再取得する必要が有るかどうかをセッションの経過時間を元にチェック */
  public function needToGetFromBrowser() {
    $session = $this->read(true);
    if (empty($session) || !array_key_exists('timestamp', $session)) return true;
    return self::hasExpired($session['timestamp'], (60 * 10)/* 10分 */);
  }
  /* 取得した現在地を元にセッション情報の更新が必要かどうかを取得したデータの位置と経過時間を元にチェック */
  public function needUpdate($data) {
    // do not update if passed data has been expired.
    if (!array_key_exists('timestamp', $data) || self::hasExpired($data['timestamp'])) return false;
    if (!array_key_exists('coords', $data)) return false;
    if (!array_key_exists('latitude', $data['coords']) || !array_key_exists('longitude', $data['coords'])) return false;

    $newLatitude  = $data['coords']['latitude'];
    $newLongitude = $data['coords']['longitude'];

    // Defaultポイントから現在地の距離が3000m以上の場合書き換えない。周辺機能サポート対象外
    $oldLatitude  = self::GEO_LATITUDE_DEFAULT;
    $oldLongitude = self::GEO_LONGITUDE_DEFAULT;
    $distance = self::distance($oldLatitude, $oldLongitude, $newLatitude, $newLongitude);
    if ($distance['distance'] > 3000) return false;

    // 以前保存したセッション内の位置から現在地の距離が100m以内の場合書き換えない。
    $existing = $this->read(true);
    if (empty($existing)) return true;
    $oldLatitude  = $existing['coords']['latitude'];
    $oldLongitude = $existing['coords']['longitude'];
    $distance = self::distance($oldLatitude, $oldLongitude, $newLatitude, $newLongitude);
    return ($distance['distance'] > 100);
  }
  public static function hasExpired($timestamp, $sec = 3600 /* 1h as default */) {
    if (empty($timestamp)) return true;
    // time():秒単位, timestamp:ミリ秒単位
    $now = time();
    $created = floor($timestamp / 1000);
    // 1時間以上経過している場合期限切れとする。
    return (($now - $created) > $sec);
  }
  //GPSなどの緯度経度の２点間の直線距離を求める（世界測地系）
  //$lat1, $lon1 --- A地点の緯度経度
  //$lat2, $lon2 --- B地点の緯度経度
  public static function distance($lat1, $lon1, $lat2, $lon2) {
    $lat_average = deg2rad( $lat1 + (($lat2 - $lat1) / 2) );//２点の緯度の平均
    $lat_difference = deg2rad( $lat1 - $lat2 );//２点の緯度差
    $lon_difference = deg2rad( $lon1 - $lon2 );//２点の経度差
    $curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
    $meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));//子午線曲率半径
    $prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);//卯酉線曲率半径
	
    //２点間の距離
    $distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
    $distance = sqrt($distance);
	
    $distance_unit = round($distance);
    if($distance_unit < 1000){//1000m以下ならメートル表記
      $distance_unit = $distance_unit."m";
    }else{//1000m以上ならkm表記
      $distance_unit = round($distance_unit / 100);
      $distance_unit = ($distance_unit / 10)."km";
    }
	
    //$hoge['distance']で小数点付きの直線距離を返す（メートル）
    //$hoge['distance_unit']で整形された直線距離を返す（1000m以下ならメートルで記述 例：836m ｜ 1000m以下は小数点第一位以上の数をkmで記述 例：2.8km）
    return array("distance" => $distance, "distance_unit" => $distance_unit);
  }

  public function initMap($data) {
    $mapInit = array();
    $mapInit['latitude'] = $data['latitude'];
    $mapInit['longitude'] = $data['longitude'];
    $this->Controller->set(compact('mapInit'));
  }
}
