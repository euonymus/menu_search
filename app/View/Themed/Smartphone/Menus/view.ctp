<? if (!is_null($menu['Menu']['image'])): ?>
<div class="row-picture">
    <?= $this->Html->image($menu['Menu']['image'], array('style'=>'width:100%')) ?>
</div>
<? endif; ?>

<div class="container">


   <h1><?= h($menu['Menu']['name']); ?><br>
      <small><?= UHelper::pictRestaurant() ?><?= $this->Html->link($menu['Restaurant']['name'], '/restaurants/view/'.$menu['Restaurant']['id']) ?></small></h1>

   <span class="label label-info"><?= UHelper::currency($menu['Menu']['price'], '\\') ?></span>
   <? if ($menu['Menu']['combo']) echo '<span class="label label-success">セットメニュー</span>&nbsp;';?>
   <?= MenuHelper::stars($menu['Menu']['point']) ?>

<? /* 今のところランチのみをターゲットとしているためわざわざ表示しない。
<? if ($menu['Menu']['lunch']) echo '<span class="label label-warning">ランチ</span>&nbsp;';?>
<? if ($menu['Menu']['dinner']) echo '<span class="label label-default">ディナー</span>';?>
*/ ?>


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

   <p><?= h($menu['Menu']['description']) ?></p>

<? if (U::notEmpty('remarks',$menu['Menu'])): ?>
   <p>備考：<?= h($menu['Menu']['remarks']) ?></p>
<? endif; ?>

<?
   $tags = explode(',',$menu['Menu']['tags']);
foreach($tags as $tag):
?>
  <?= $this->Html->link($tag,'/menus/?tags='.$tag, array('class'=> 'btn btn-primary btn-xs')) ?>
<? endforeach; ?>

</div>

<?= $this->Map->mapIfExists() ?>


