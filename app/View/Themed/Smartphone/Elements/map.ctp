<?
if (!isset($asInput)) $asInput = false;
if (!isset($model)) $model = false;
if (!isset($showAlways)) $showAlways = true;
$hasPosition = $this->Map->initGmapLib();
?>
<? if ($showAlways || $hasPosition): ?>
<? $this->Html->scriptStart(array('inline' => false)); ?>
    var presentMap = {
        successCallback: (function(position){
            <? if ($asInput): ?> position.coords.hasInput = true; <? endif; ?>
	    gmap.render(position.coords);
        }),
    }
    $(function() {
  <? if ($hasPosition): ?>
	data = {"hasMarker":true};
        <? if ($asInput): ?> data.hasInput = true; <? endif; ?>
        gmap.render(data);
  <? else: ?>
	gmap.getLocation(presentMap);
  <? endif; /* if ($hasPosition) */ ?>
    });
<? $this->Html->scriptEnd(); ?>


<? if ($asInput): ?><div class="form-group"><? endif; ?>
  <div id="map" style="height:120pt"></div>
<? if ($asInput): ?><?= $this->element('latlngInput', array('model' => $model)) ?></div><? endif; ?>

<? endif; /* if ($showAlways || $hasPosition) */?>
