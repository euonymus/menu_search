<? if (isset($breadcrumb) && $breadcrumb):?>
      <ol class="breadcrumb">
<? foreach($breadcrumb as $key => $val): ?>
      <? if ($val):?>
            <li><a href="<?= $val ?>"><?= $key ?></a></li>
      <? else: ?>
            <li class="active"><?= $key ?></li>
      <? endif; ?>
<? endforeach; ?>
      </ol>
<? endif; ?>