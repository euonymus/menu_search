<div class="words index">
	<h2><?php echo __('Words'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('start'); ?></th>
			<th><?php echo $this->Paginator->sort('end'); ?></th>
			<th><?php echo $this->Paginator->sort('start_accuracy'); ?></th>
			<th><?php echo $this->Paginator->sort('end_accuracy'); ?></th>
			<th><?php echo $this->Paginator->sort('is_momentary'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($words as $word): ?>
	<tr>
		<td><?php echo h($word['Word']['id']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['name']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['description']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['start']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['end']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['start_accuracy']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['end_accuracy']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['is_momentary']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['created']); ?>&nbsp;</td>
		<td><?php echo h($word['Word']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $word['Word']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $word['Word']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $word['Word']['id']), array(), __('Are you sure you want to delete # %s?', $word['Word']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Word'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Words'), array('controller' => 'words', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related'), array('controller' => 'words', 'action' => 'add')); ?> </li>
	</ul>
</div>
