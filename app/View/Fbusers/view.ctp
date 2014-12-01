<div class="fbusers view">
<h2><?php echo __('Fbuser'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hometown Id'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['hometown_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hometown Name'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['hometown_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timezone'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['timezone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locale'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['locale']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Verified'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['verified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated Time'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['updated_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Token'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Token Expires'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['token_expires']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($fbuser['Fbuser']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fbuser'), array('action' => 'edit', $fbuser['Fbuser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fbuser'), array('action' => 'delete', $fbuser['Fbuser']['id']), array(), __('Are you sure you want to delete # %s?', $fbuser['Fbuser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fbusers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fbuser'), array('action' => 'add')); ?> </li>
	</ul>
</div>
