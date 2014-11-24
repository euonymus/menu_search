<div class="well bs-component">
    <h2><?= $station ?> - <?= $tags ?></h2>
    <p><? $tagList = explode(',',$tags); foreach ($tagList as $tag){ echo '「'.$tag.'」';} ?>でレストランのメニューを検索した結果</p>

    <div>
      <?= $this->Html->link('別の地域で検索', '/menus/region_filter/?tags='. $tags, array('class' => 'btn btn-success btn-lg')) ?>
    </div>

    <?= $this->element('js_menu_list') ?>
</div>
