<div class="words form">
<?php echo $this->Form->create('Word'); ?>
	<fieldset>
		<legend><?php echo __('Edit Word'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
?>
    <div class="form-group">
      <label for="Word">開始日</label>
      <?= $this->Form->date('start', array('value'=>U::toDate($this->data['Word']['start']))) ?>
      <?= $this->Form->error("start"); ?>
    </div>
    <div class="form-group">
      <label for="Word">終了日</label>
      <?= $this->Form->date('end', array('value'=>U::toDate($this->data['Word']['end']))) ?>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Word.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Word.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Words'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Words'), array('controller' => 'words', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related'), array('controller' => 'words', 'action' => 'add')); ?> </li>
	</ul>
</div>
