<div class="well bs-component">
    <h2><?= $station ?> - <?= $tags ?></h2>
    <p><? $tagList = explode(',',$tags); foreach ($tagList as $tag){ echo '「'.$tag.'」';} ?>でレストランのメニューを検索した結果</p>

    <ul class="nav nav-pills">
      <li class="active"><?= $this->Html->link('別のメニュー', '/menus/' . (!empty($station_id) ? '?station='. $station_id : ''), array()) ?></li>
      <li class="active"><?= $this->Html->link('別の地域', '/menus/region_filter/?tags='. $tags, array()) ?></li>
    </ul>

<? /*
    <div>
      <?= $this->Html->link('別の地域で検索', '/menus/region_filter/?tags='. $t
    </div>
*/ ?>
    <br>
    <?= $this->element('js_menu_list') ?>
</div>
