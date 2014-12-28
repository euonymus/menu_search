<div class="container">
   <h1><?= h($restaurant['Restaurant']['name']) ?></h1>

<? if (!empty($restaurant['Restaurant']['description'])): ?>
   <dl>
      <dt>レストランの説明</dt>
      <dd>
         <?= h($restaurant['Restaurant']['description']) ?>&nbsp;
      </dd>
   </dl>
<? endif; ?>

 <? foreach ($restaurant['Station'] as $station): ?>
   <div>
      <span class="label label-primary"><?= $station['name'] ?></span>
   </div>
 <? endforeach; ?>
</div>

<?= $this->Map->mapIfExists() ?>

<?= $this->element('js_menu_list') ?>

