<div class="fbusers index">
	<h2><?php echo __('Fbusers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('link'); ?></th>
			<th><?php echo $this->Paginator->sort('hometown_id'); ?></th>
			<th><?php echo $this->Paginator->sort('hometown_name'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('timezone'); ?></th>
			<th><?php echo $this->Paginator->sort('locale'); ?></th>
			<th><?php echo $this->Paginator->sort('verified'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_time'); ?></th>
			<th><?php echo $this->Paginator->sort('token'); ?></th>
			<th><?php echo $this->Paginator->sort('token_expires'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($fbusers as $fbuser): ?>
	<tr>
		<td><?php echo h($fbuser['Fbuser']['id']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['name']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['username']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['link']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['hometown_id']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['hometown_name']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['gender']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['email']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['timezone']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['locale']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['verified']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['updated_time']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['token']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['token_expires']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['status']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['created']); ?>&nbsp;</td>
		<td><?php echo h($fbuser['Fbuser']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fbuser['Fbuser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fbuser['Fbuser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fbuser['Fbuser']['id']), array(), __('Are you sure you want to delete # %s?', $fbuser['Fbuser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Fbuser'), array('action' => 'add')); ?></li>
	</ul>
</div>
