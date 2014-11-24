<div>
<h1>メニュー検索</h1>
<p>地域を選択してください</p>
<? foreach($stations as $id => $station): ?>
<div class="station-btn text-center">
  <?= $this->Html->link($station, '/menus/?station='.$id, array('class' => 'btn btn-success btn-lg')) ?>
</div>
<? endforeach; ?>

</div>