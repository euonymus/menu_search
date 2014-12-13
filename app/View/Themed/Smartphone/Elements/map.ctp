<?
$hasPosition = false;
if (U::notEmpty('latitude', $position) && U::notEmpty('longitude', $position)) {
  $hasPosition = true;
  $latitude = $position['latitude'];
  $longitude = $position['longitude'];
}
?>


<?= $this->Html->script('//maps.google.com/maps/api/js?v=3&sensor=false') ?>
<?= $this->element('js_map', compact('latitude', 'longitude')) ?>
<? $this->Html->scriptStart(array('inline' => false)); ?>
    var presentMap = {
        successCallback: (function(position){
<? if ($hasPosition): ?>
	    gmap.init();
	    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	    var marker = new google.maps.Marker({
                position: latlng,
	        map: map,
            });
<? else: ?>
	    gmap.init(position.coords);
<? endif; ?>
	    gmap.onClickCallback(gmap.setLatLngInput);
        }),
    }
    $(function() {
	gmap.getLocation(presentMap);
    });
<? $this->Html->scriptEnd(); ?>



        <div class="form-group">
            <div id="map" style="height:250pt"></div>
        </div>
        <?= $this->Form->input('latitude', array('id' => 'show_lat')) ?>
        <?= $this->Form->input('longitude', array('id' => 'show_lng')) ?>
