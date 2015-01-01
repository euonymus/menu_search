<? $Schema = (isset($model) && is_string($model) && !empty($model)) ? $model.'.' : ''; ?>
<?= $this->Form->hidden($Schema.'latitude', array('id' => 'show_lat')) ?>
<?= $this->Form->hidden($Schema.'longitude', array('id' => 'show_lng')) ?>

