<div class="well bs-component">
    <h2>メニュー一覧</h2>
    <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?></li>
	</ul>
    </div>
    <?= $this->element('menu_list') ?>
</div>
