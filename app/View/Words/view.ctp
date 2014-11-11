<div class="words view">
<h2><?php echo __('Word'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($word['Word']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($word['Word']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($word['Word']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo h($word['Word']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo h($word['Word']['end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Accuracy'); ?></dt>
		<dd>
			<?php echo h($word['Word']['start_accuracy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Accuracy'); ?></dt>
		<dd>
			<?php echo h($word['Word']['end_accuracy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Momentary'); ?></dt>
		<dd>
			<?php echo h($word['Word']['is_momentary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($word['Word']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($word['Word']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Word'), array('action' => 'edit', $word['Word']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Word'), array('action' => 'delete', $word['Word']['id']), array(), __('Are you sure you want to delete # %s?', $word['Word']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Words'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Word'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Words'), array('controller' => 'words', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related'), array('controller' => 'words', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Words'); ?></h3>
	<?php if (!empty($word['Related'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Start Accuracy'); ?></th>
		<th><?php echo __('End Accuracy'); ?></th>
		<th><?php echo __('Is Momentary'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($word['Related'] as $related): ?>
		<tr>
			<td><?php echo $related['id']; ?></td>
			<td><?php echo $related['name']; ?></td>
			<td><?php echo $related['description']; ?></td>
			<td><?php echo $related['start']; ?></td>
			<td><?php echo $related['end']; ?></td>
			<td><?php echo $related['start_accuracy']; ?></td>
			<td><?php echo $related['end_accuracy']; ?></td>
			<td><?php echo $related['is_momentary']; ?></td>
			<td><?php echo $related['created']; ?></td>
			<td><?php echo $related['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'words', 'action' => 'view', $related['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'words', 'action' => 'edit', $related['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'words', 'action' => 'delete', $related['id']), array(), __('Are you sure you want to delete # %s?', $related['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Related'), array('controller' => 'words', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
