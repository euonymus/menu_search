<div class="container">
    <h1><?= $this->Menu->searchTitle() ?></h1>
    <div class="menu-search-methods">

            <?= $this->Html->link(UHelper::pictCafe('14pt').'種類から', '/menus/categories/',
                  array('escape' => false, 'class' => 'search-method')); ?>
            <?= $this->Html->link(UHelper::pictTrain('14pt').'駅から', '/menus/region/',
                  array('escape' => false, 'class' => 'search-method')); ?>
            <div class="clear"></div>

    </div>
</div>

<?= $this->element('js_menu_list') ?>
