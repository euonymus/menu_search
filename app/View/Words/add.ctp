<div class="words form">
<?php echo $this->Form->create('Word'); ?>
	<fieldset>
		<legend><?php echo __('Add Word'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
?>
    <div class="form-group">
      <label for="Word">開始日</label>
      <?= $this->Form->date('start') ?>
      <?= $this->Form->error("start"); ?>
    </div>
    <div class="form-group">
      <label for="Word">終了日</label>
      <?= $this->Form->date('end') ?>
      <?= $this->Form->error("end"); ?>
    </div>

<?php
		echo $this->Form->input('start_accuracy');
		echo $this->Form->input('end_accuracy');
		echo $this->Form->input('is_momentary');
		echo $this->Form->input('Related');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Words'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Words'), array('controller' => 'words', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related'), array('controller' => 'words', 'action' => 'add')); ?> </li>
	</ul>
</div>
