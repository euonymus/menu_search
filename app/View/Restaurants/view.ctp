<div class="bs-docs-section">
<div class="well bs-component">
<h2><?php echo h($restaurant['Restaurant']['name']); ?></h2>
<dl>
	<dt>レストランの説明</dt>
	<dd>
		<?php echo h($restaurant['Restaurant']['description']); ?>
		&nbsp;
	</dd>
</dl>
</div>

<div class="well bs-component">
 <?= $this->element('menu_list') ?>
</div>

</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Restaurant'), array('action' => 'edit', $restaurant['Restaurant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Restaurant'), array('action' => 'delete', $restaurant['Restaurant']['id']), array(), __('Are you sure you want to delete # %s?', $restaurant['Restaurant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('action' => 'add')); ?> </li>
	</ul>
</div>
