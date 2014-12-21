<div class="bs-docs-section">
<div class="well bs-component">

   <h2><?php echo h($menu['Menu']['name']); ?><br>
       <?= UHelper::pictRestaurant() ?><?php
echo $this->Html->link($menu['Restaurant']['name'], '/restaurants/view/'.$menu['Restaurant']['id']);
?></h2>
<h4>
<span class="label label-info"><?= UHelper::currency($menu['Menu']['price'], '\\') ?></span>
<? if ($menu['Menu']['combo']) echo '<span class="label label-success">セットメニュー</span>&nbsp;';?>

<?= MenuHelper::stars($menu['Menu']['point']) ?>

<? /* 今のところランチのみをターゲットとしているためわざわざ表示しない。
<? if ($menu['Menu']['lunch']) echo '<span class="label label-warning">ランチ</span>&nbsp;';?>
<? if ($menu['Menu']['dinner']) echo '<span class="label label-default">ディナー</span>';?>
*/ ?>
</h4>

<div>
<? if ($liked) {
    $undo = 'undo:1/';
    $likeBtnMessage = UHelper::pictClear('13pt', 'pink').'お気に入り解除';
    echo UHelper::pictHeart('20pt', 'pink');
} else {
    $undo = '';
    $likeBtnMessage = UHelper::pictHeart('13pt', 'pink').'お気に入りに登録！';
} ?>
   <?= $this->Html->link($likeBtnMessage, '/menus/like/'.$undo.$menu['Menu']['id'], array('escape'=>false,'class'=>'btn btn-default btn-raised')) ?> 
</div>

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
  <?= $this->Html->link($tag,'/menus/?tags='.$tag, array('class'=> 'btn btn-primary btn-xs')) ?>
<? endforeach; ?>
</h4>

<?= $this->Map->mapIfExists() ?>

</div>
</div>
