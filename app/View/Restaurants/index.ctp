<div class="well bs-component">
    <h2>レストラン一覧</h2>
    <div class="actions">
	<ul>
		<li><?php echo $this->Html->link('レストランを新しく登録する', array('action' => 'add')); ?></li>
	</ul>
    </div>
<br>
<br>
    <table class="table table-striped table-hover">
<? /*
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
*/ ?>
	<tbody>
	<?php foreach ($restaurants as $restaurant): ?>
	<tr>
            <td>
<?php
   $anchor = h($restaurant['Restaurant']['name']);
   $anchor .= '<br>';
   $anchor .= h($restaurant['Restaurant']['description']);

   $url = array('action' => 'view',
		$restaurant['Restaurant']['id']);
   $options = array('escape' => false,
		    'style' => 'display:block;width:100%;height:100%',
		    );
   echo $this->Html->link($anchor, $url, $options);
?>
</td>
<? /*
		<td><?php echo h($restaurant['Restaurant']['name']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['description']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['created']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $restaurant['Restaurant']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $restaurant['Restaurant']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $restaurant['Restaurant']['id']), array(), __('Are you sure you want to delete # %s?', $restaurant['Restaurant']['id'])); ?>
		</td>
*/ ?>
	</tr>
<?php endforeach; ?>
	</tbody>
    </table>


    <?= $this->element('paginator') ?>
</div>
