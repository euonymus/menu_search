<?= $this->Map->updateLocation() ?>
<div class="container">
    <h1><?= $this->Menu->searchTitle() ?></h1>

    <ul class="nav nav-pills">
      <li class="active"><?= $this->Html->link('別のメニュー', '/menus/categories/') ?></li>
      <li class="active"><?= $this->Html->link('別の地域', '/menus/region/') ?></li>
    </ul>

<? /*
    <div>
      <?= $this->Html->link('別の地域で検索', '/menus/region_filter/?tags='. $t
    </div>
*/ ?>
</div>

<?= $this->element('js_menu_list') ?>
