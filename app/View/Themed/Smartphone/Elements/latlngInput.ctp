<? $Schema = (isset($model) && is_string($model) && !empty($model)) ? $model.'.' : ''; ?>
<?= $this->Form->input($Schema.'latitude', array('id' => 'show_lat')) ?>
<?= $this->Form->input($Schema.'longitude', array('id' => 'show_lng')) ?>

