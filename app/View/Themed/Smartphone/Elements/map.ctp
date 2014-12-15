<?
$hasPosition = $this->Map->initGmapLib();
if (!isset($asInput)) $asInput = false;
?>
<? $this->Html->scriptStart(array('inline' => false)); ?>
    var presentMap = {
        successCallback: (function(position){
	    gmap.init(position.coords);
<? if ($asInput): ?>
	    gmap.onClickCallback(gmap.setLatLngInput);
<? endif; ?>
        }),
    }
    $(function() {
<? if ($hasPosition): ?>
	    gmap.init();
	    gmap.marker();
    <? if ($asInput): ?>
	    gmap.onClickCallback(gmap.setLatLngInput);
    <? endif; ?>
<? else: ?>
	gmap.getLocation(presentMap);
<? endif; ?>
    });
<? $this->Html->scriptEnd(); ?>

        <div class="form-group">
            <div id="map" style="height:120pt"></div>
        </div>

<? if ($asInput): ?>
        <?= $this->Form->input('latitude', array('id' => 'show_lat')) ?>
        <?= $this->Form->input('longitude', array('id' => 'show_lng')) ?>
<? endif; ?>
