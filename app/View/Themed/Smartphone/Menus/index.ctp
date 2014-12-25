<?= $this->Map->updateLocation() ?>
<div class="container">
    <h1><?= $this->Menu->searchTitle() ?></h1>
    <?= $this->Html->link(UHelper::pictCafe('16pt').'種類を絞る', '/menus/categories/',
          array('escape' => false, 'class' => 'btn')); ?>
    <?= $this->Html->link(UHelper::pictTrain('16pt').'駅を選ぶ', '/menus/region/',
          array('escape' => false, 'class' => 'btn')); ?>
</div>

<?= $this->element('js_menu_list') ?>
