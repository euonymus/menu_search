<div class="bs-docs-section">
<div class="well bs-component">

   <h2><?php echo h($menu['Menu']['name']); ?>&nbsp;@&nbsp;<?php
echo $this->Html->link($menu['Restaurant']['name'], '/restaurants/view/'.$menu['Restaurant']['id']);
?></h2>
<h4>
<span class="label label-info"><?= UHelper::currency($menu['Menu']['price'], '\\') ?></span>
<? if ($menu['Menu']['combo']) echo '<span class="label label-success">セットメニュー</span>&nbsp;';?>
<? if ($menu['Menu']['lunch']) echo '<span class="label label-warning">ランチ</span>&nbsp;';?>
<? if ($menu['Menu']['dinner']) echo '<span class="label label-default">ディナー</span>';?>
</h4>



        <div class="row-picture">
      <? if (!is_null($menu['Menu']['image'])) echo $this->Html->image($menu['Menu']['image'], array('alt'=>'icon','class'=>'img-thumbnail', 'style'=>'width:180px;height:180px;')); ?>
        </div>



   <p><?php echo h($menu['Menu']['description']); ?></p>

<? if (U::notEmpty('remarks',$menu['Menu'])): ?>
   <p>備考：<?php echo h($menu['Menu']['remarks']); ?></p>
<? endif; ?>

<h4>
<?
   $tags = explode(',',$menu['Menu']['tags']);
foreach($tags as $tag):
?>
  <?= $this->Html->link($tag,'/menus/search/?tags='.$tag, array('class'=> 'btn btn-primary btn-xs')) ?>
<? endforeach; ?>
</h4>

</div>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), array(), __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>
	</ul>
</div>
