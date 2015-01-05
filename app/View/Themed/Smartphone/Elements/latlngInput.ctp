<? $Schema = (isset($model) && is_string($model) && !empty($model)) ? $model.'.' : ''; ?>
<? if (isset($showLatLngInput) && $showLatLngInput): ?>
<?= $this->Form->input('latitude', array('id' => 'show_lat')) ?>
<?= $this->Form->input('longitude', array('id' => 'show_lng')) ?>
<? else: ?>
<?= $this->Form->hidden($Schema.'latitude', array('id' => 'show_lat')) ?>
<?= $this->Form->hidden($Schema.'longitude', array('id' => 'show_lng')) ?>
<? endif; ?>
