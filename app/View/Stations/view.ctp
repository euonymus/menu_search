<div class="stations view">
<h2><?php echo __('Station'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($station['Station']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($station['Station']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Line'); ?></dt>
		<dd>
			<?php echo h($station['Station']['line']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($station['Station']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($station['Station']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Station'), array('action' => 'edit', $station['Station']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Station'), array('action' => 'delete', $station['Station']['id']), array(), __('Are you sure you want to delete # %s?', $station['Station']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station'), array('action' => 'add')); ?> </li>
	</ul>
</div>
