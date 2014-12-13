<?
if (!isset($latitude)) $latitude = '35.64418424015282';
if (!isset($longitude)) $longitude = '139.69862937927246';
if (!isset($zoom)) $zoom = '16';
?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
var gmap = {
  map:false,
  init: (function(data){
      // Google Mapで利用する初期設定用の変数
      var latlng = new google.maps.LatLng(<?= $latitude ?>, <?= $longitude ?>);
      var opts = {
        zoom: <?= $zoom ?>,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: latlng
      };

      // getElementById("map")の"map"は、body内の<div id="map">より
      parent.map = new google.maps.Map(document.getElementById("map"), opts);
  }),
  onClickCallback: (function(data){
      google.maps.event.addListener(parent.map, 'click', data);
  }),
  setLatLngInput: (function(event){
      document.getElementById("show_lat").setAttribute("value",event.latLng.lat());
      document.getElementById("show_lng").setAttribute("value",event.latLng.lng());
  }),
}
<?php $this->Html->scriptEnd(); ?>
