<div class="container">
   <h1><?= h($restaurant['Restaurant']['name']) ?></h1>
   <dl>
      <dt>レストランの説明</dt>
      <dd>
         <?= h($restaurant['Restaurant']['description']) ?>&nbsp;
      </dd>
   </dl>
 <? foreach ($restaurant['Station'] as $station): ?>
   <div>
      <span class="label label-primary"><?= $station['name'] ?></span>
      <br>
      <br>
   </div>
 <? endforeach; ?>
</div>

<?= $this->Map->mapIfExists() ?>

<?= $this->element('js_menu_list') ?>

