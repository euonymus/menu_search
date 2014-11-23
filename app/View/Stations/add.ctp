<div class="stations form">
<?php echo $this->Form->create('Station'); ?>
	<fieldset>
		<legend><?php echo __('Add Station'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('line');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stations'), array('action' => 'index')); ?></li>
	</ul>
</div>
