<? if (U::arrPrepared('horizontal_image', $menu['Menu']) && !is_null($menu['Menu']['horizontal_image'])): ?>
<div class="row-picture">
    <?= $this->Html->image($menu['Menu']['horizontal_image']) ?>
</div>
<? endif; ?>
<? foreach($menu['MenuImage'] as $image):?>
<?= $this->Html->image($image['thumbnail'], array('class'=>'menu-image-s')) ?>
<? endforeach; ?>

<div class="container">
   <?= $this->element('social_buttons') ?>
</div>

<div class="container">
   <h1><?= h($menu['Menu']['name']); ?><br>
      <small><?= UHelper::pictRestaurant() ?><?= $this->Html->link($menu['Restaurant']['name'], '/restaurants/view/'.$menu['Restaurant']['id']) ?></small></h1>

   <span class="price"><?= UHelper::currency($menu['Menu']['price'], '\\') ?></span>
   <? if ($menu['Menu']['combo']) echo '<span class="label label-success">セットメニュー</span>&nbsp;';?>
   <?= MenuHelper::stars($menu['Menu']['point']) ?>

<? /* 今のところランチのみをターゲットとしているためわざわざ表示しない。
<? if ($menu['Menu']['lunch']) echo '<span class="label label-warning">ランチ</span>&nbsp;';?>
<? if ($menu['Menu']['dinner']) echo '<span class="label label-default">ディナー</span>';?>
*/ ?>

   <div>

<? if ($this->User->loggedIn()): ?>
    <? if ($liked) {
        $undo = 'undo:1/';
        $likeBtnMessage = UHelper::pictClear('13pt', 'pink').'お気に入り解除';
        echo UHelper::pictHeart('20pt', 'pink');
    } else {
        $undo = '';
        $likeBtnMessage = UHelper::pictHeart('13pt', 'pink').'お気に入りに登録！';
    } ?>
    <? $linkUri = '/menus/like/'.$undo.$menu['Menu']['id']; ?>
<? else: ?>

    <?
    $likeBtnMessage = UHelper::pictHeart('13pt', 'pink').'お気に入りに登録！';
    $linkUri = '/users/login/?location=' . urlencode('/menus/like/'.$menu['Menu']['id']);
    ?>

<? endif; ?>
      <? $linkOption = array('escape'=>false,'class'=>'btn btn-default btn-raised'); ?>
      <?= $this->Html->link($likeBtnMessage, $linkUri, $linkOption) ?> 

   </div>

   <p><?= h($menu['Menu']['description']) ?></p>

<? if (U::notEmpty('remarks',$menu['Menu'])): ?>
   <p>備考：<?= h($menu['Menu']['remarks']) ?></p>
<? endif; ?>

<?
   $tags = explode(',',$menu['Menu']['tags']);
foreach($tags as $tag):
if (isset($station_id) && !empty($station_id)) $station_query = '&station_id='.$station_id;
else $station_query = '';
?>
  <?= $this->Html->link($tag,'/menus/?tags='.$tag.$station_query, array('class'=> 'btn btn-primary btn-xs')) ?>
<? endforeach; ?>

</div>

<?= $this->Map->mapIfExists() ?>


