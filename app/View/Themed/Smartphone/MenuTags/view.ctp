<div class="menuTags view">
<h2><?php echo __('Menu Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menuTag['MenuTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menu'); ?></dt>
		<dd>
			<?php echo h($menuTag['MenuTag']['menu']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accessories'); ?></dt>
		<dd>
			<?php echo h($menuTag['MenuTag']['accessories']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($menuTag['MenuTag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($menuTag['MenuTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu Tag'), array('action' => 'edit', $menuTag['MenuTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu Tag'), array('action' => 'delete', $menuTag['MenuTag']['id']), array(), __('Are you sure you want to delete # %s?', $menuTag['MenuTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Tag'), array('action' => 'add')); ?> </li>
	</ul>
</div>
