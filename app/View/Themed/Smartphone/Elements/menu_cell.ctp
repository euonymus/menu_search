<div class="list-group">
    <div class="list-group-item">
        <div class="row-picture">
   <? if (!is_null($menu['Menu']['image'])) echo $this->Html->image($menu['Menu']['image'], array('alt'=>'icon')); ?>
        </div>
        <div class="row-content">
   <h4 class="list-group-item-heading"><?= h($menu['Menu']['name']) ?>&nbsp;<small><i class="mdi-action-home" style="font-size: 20pt;"></i><?= h($menu['Restaurant']['name']) ?></small></h4>
            <small class="list-group-item-text"><?= h($menu['Menu']['description']) ?></small>
            <? if (!U::isEmpty('remarks',$menu['Menu'])): ?>
            <p><small class="list-group-item-text">備考：<?= h($menu['Menu']['remarks']) ?></small></p>
            <? endif; ?>
            <p class="list-group-item-text">
<span class="label label-info"><?= UHelper::currency($menu['Menu']['price'], '\\') ?></span>
<? if ($menu['Menu']['combo']) echo '<span class="label label-success">セットメニュー</span>&nbsp;';?>
<? if ($menu['Menu']['lunch']) echo '<span class="label label-warning">ランチ</span>&nbsp;';?>
<? if ($menu['Menu']['dinner']) echo '<span class="label label-default">ディナー</span>';?>
            </p>
        </div>
    </div>

</div>
<? //echo h($menu['Menu']['point']);?>