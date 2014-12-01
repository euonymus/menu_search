<div class="fbusers form">
<?php echo $this->Form->create('Fbuser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Fbuser'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('username');
		echo $this->Form->input('link');
		echo $this->Form->input('hometown_id');
		echo $this->Form->input('hometown_name');
		echo $this->Form->input('gender');
		echo $this->Form->input('email');
		echo $this->Form->input('timezone');
		echo $this->Form->input('locale');
		echo $this->Form->input('verified');
		echo $this->Form->input('updated_time');
		echo $this->Form->input('token');
		echo $this->Form->input('token_expires');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Fbuser.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Fbuser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fbusers'), array('action' => 'index')); ?></li>
	</ul>
</div>
