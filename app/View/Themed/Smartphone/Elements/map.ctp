<?
$hasPosition = $this->Map->initGmapLib();
if (!isset($asInput)) $asInput = false;
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
	    alert(position.coords.latitude);
	    alert(position.coords.longitude);


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
