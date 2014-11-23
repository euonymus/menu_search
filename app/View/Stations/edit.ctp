<div class="stations form">
<?php echo $this->Form->create('Station'); ?>
	<fieldset>
		<legend><?php echo __('Edit Station'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('line');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Station.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Station.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Stations'), array('action' => 'index')); ?></li>
	</ul>
</div>
