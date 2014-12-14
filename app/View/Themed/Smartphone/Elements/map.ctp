<?
// Initialization
$hasPosition = false;
if (isset($position) && U::notEmpty('latitude', $position) && U::notEmpty('longitude', $position)) {
  $hasPosition = true;
  $latitude = $position['latitude'];
  $longitude = $position['longitude'];
}
if (!isset($asInput)) $asInput = false;
// Read Javascripts
echo $this->Html->script('//maps.google.com/maps/api/js?v=3&sensor=false');
echo $this->element('js_map', compact('latitude', 'longitude'));
?>
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
<? if ($asInput): ?>
	    gmap.onClickCallback(gmap.setLatLngInput);
<? endif; ?>
        }),
    }
    $(function() {
	gmap.getLocation(presentMap);
    });
<? $this->Html->scriptEnd(); ?>

        <div class="form-group">
            <div id="map" style="height:120pt"></div>
        </div>

<? if ($asInput): ?>
        <?= $this->Form->input('latitude', array('id' => 'show_lat')) ?>
        <?= $this->Form->input('longitude', array('id' => 'show_lng')) ?>
<? endif; ?>
