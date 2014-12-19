<div class="bs-docs-section">

<div class="well bs-component">
<h2><?php echo h($restaurant['Restaurant']['name']); ?></h2>
    <dl>
	<dt>レストランの説明</dt>
	<dd>
		<?php echo h($restaurant['Restaurant']['description']); ?>
		&nbsp;
	</dd>
    </dl>
    <div>
 <? foreach ($restaurant['Station'] as $station): ?>
        <span class="label label-default"><?= $station['name'] ?></span>
 <? endforeach; ?>
    </div>
</div>


<?= $this->Map->map() ?>


<div class="well bs-component">
 <?= $this->element('js_menu_list') ?>
</div>

</div>

