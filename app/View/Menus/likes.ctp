<div class="container">
    <h1>お気に入りランチメニュー</h1>
    <p>お客様がお気に入り登録したランチメニュー一覧</p>

    <div class="well">
        <small>
            <?= $this->Html->link(UHelper::pictTrain('16pt').'駅から', '/menus/region/',
                  array('escape' => false, 'class' => 'btn')); ?>
        </small>
    </div>
</div>

<?= $this->element('js_menu_list') ?>
