<div class="well bs-component">
    <h2>メニュー検索 - <?= $tags ?></h2>
    <p><? $tagList = explode(',',$tags); foreach ($tagList as $tag){ echo '「'.$tag.'」';} ?>でレストランのメニューを検索した結果</p>
    <?= $this->element('menu_list') ?>
</div>
