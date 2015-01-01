<? /* Initial Settings are set by element attributes */
/* Attributes:  $latitude, $longitude, $zoom, $draggable */
if (!isset($latitude)) $latitude = '35.64418424015282';
if (!isset($longitude)) $longitude = '139.69862937927246';
if (!isset($zoom)) $zoom = '16';
if (isset($withPlace) && $withPlace) $place_query = '&libraries=places';
else $place_query = '';
echo $this->Html->script('//maps.google.com/maps/api/js?v=3&sensor=false'.$place_query);
?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
var gmap = {
  map:false,
  latitude:false,
  longitude:false,

  render: (function(data){
      gmap.init(data);
      if (data.hasMarker) {
	gmap.marker();
      }
      if (data.hasInput) {
	gmap.onClickCallback(gmap.setLatLngInput);
      }
  }),
  init: (function(data){
      // Google Mapで利用する初期設定用の変数
      if (typeof data !== 'undefined') {
          if ((typeof data.latitude !== 'undefined') && (typeof data.longitude !== 'undefined')) {
              latitude = data.latitude;
              longitude = data.longitude;
          } else {
              latitude = '<?= $latitude ?>';
              longitude = '<?= $longitude ?>';
          }
      } else {
          latitude = '<?= $latitude ?>';
          longitude = '<?= $longitude ?>';
      }
      parent.latitude = latitude;
      parent.longitude = longitude;

      var latlng = new google.maps.LatLng(latitude, longitude);
      var opts = {
          zoom: <?= $zoom ?>,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: latlng,
<? if (isset($draggable)): ?>
          draggable: <?= $draggable ? 'true' : 'false' ?>,
<? endif; ?>
      };
      // getElementById("map")の"map"は、body内の<div id="map">より
      parent.map = new google.maps.Map(document.getElementById("map"), opts);
  }),
  marker: (function(){
      var latlng = new google.maps.LatLng(parent.latitude, parent.longitude);
      var marker = new google.maps.Marker({
	position: latlng,
	    map: map,
      });
  }),
  onClickCallback: (function(data){
      google.maps.event.addListener(parent.map, 'click', data);
  }),
  setLatLngInput: (function(event){
      document.getElementById("show_lat").setAttribute("value",event.latLng.lat());
      document.getElementById("show_lng").setAttribute("value",event.latLng.lng());


      var latlng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
      var marker = new google.maps.Marker({
	position: latlng,
	    map:parent.map,
      });


  }),
  // 位置情報取得開始。data has to have successCallback and errorCallback functions.
  getLocation: (function(data){
    var opts = {
        // 高精度な位置情報を取得するか(デフォルトはfalse)
        enableHightAccuracy: true,
        // 取得した位置情報をキャッシュする時間(ミリ秒。デフォルトは0)
        maximumAge: 0,
        // 何秒でタイムアウトとするか(ミリ秒。タイムアウトするとerrorCallback()がコールされる)
        timeout: 120000
    };
    // ブラウザがGeolocation APIに対応しているかをチェック
    if (navigator.geolocation) {
        // 対応している → 位置情報取得開始
        // 位置情報取得成功時にsuccessCallback()、そして取得失敗時にerrorCallback()がコールされる
        // optsはgetCurrentPosition()に渡す設定値
	if ((typeof data !== 'undefined') && (typeof data.errorCallback !== 'undefined')) {
	  errorCallback = data.errorCallback;
	} else {
	  errorCallback = gmap.errorCallback;
	}
        navigator.geolocation.getCurrentPosition(data.successCallback, errorCallback , opts);
    } else {
        // 対応していない → alertを表示するのみ
        alert("Geolocation not supported in this browser");
    }
  }),
  // 位置情報取得処理が成功した時にコールされる関数
  // 引数として、coords(coordinates。緯度・経度など)とtimestamp(タイムスタンプ)の2つを持ったpositionが渡される
  successCallback: (function(position){
      // position.coords.latitude  緯度(-180～180度) ★必ず取得できる
      // position.coords.longitude 経度(-90～90度) ★必ず取得できる
      // position.coords.altitude  高度(m)
      // position.coords.accuracy  緯度・経度の誤差(m) ★必ず取得できる
      // position.coords.altitudeAccuracy 高度の誤差(m)
      // position.coords.heading   方角(0～360度)
      // position.coords.speed     速度(m/秒)
      // position.timestamp        引数positionからtimestamp(位置情報を取得した時刻のミリ秒)を取り出す ★必ず取得できる
      gmap.init( position.coords);
  }),
  // 位置情報取得処理が失敗した時にコールされる関数
  // 引数として、code(コード)とmessage(メッセージ)の2つを持ったpositionErrorが渡される
  errorCallback: (function(positionError){
    // 引数positionErrorの中身2つを取り出す
    // コード(1～3のいずれかの値)
    var code = positionError.code;
    // メッセージ(開発者向けデバッグ用メッセージ)
    var message = positionError.message;
     
    // コードに応じたメッセージを表示
    switch (code) {
        case positionError.PERMISSION_DENIED: // codeが1
	    alert("GeolocationAPIのアクセス許可がありません");
	    break;
        case positionError.POSITION_UNAVAILABLE: // codeが2
	    alert("現在の位置情報を特定できませんでした");
            break;
        case positionError.TIMEOUT: // codeが3
            alert("指定されたタイムアウト時間内に現在の位置情報を特定できませんでした");
            break;
    }
  }),
}
<?php $this->Html->scriptEnd(); ?>
