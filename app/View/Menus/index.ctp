<div class="container">
    <h1><?= $this->Menu->searchTitle() ?></h1>
    <div class="well">
        <small>
            <?= $this->Html->link(UHelper::pictCafe('16pt').'種類から', '/menus/categories/',
                  array('escape' => false, 'class' => 'btn')); ?>
            <?= $this->Html->link(UHelper::pictTrain('16pt').'駅から', '/menus/region/',
                  array('escape' => false, 'class' => 'btn')); ?>
        </small>
    </div>
</div>

<?= $this->element('js_menu_list') ?>
