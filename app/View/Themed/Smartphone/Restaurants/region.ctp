<div>
<h1>レストラン検索</h1>
<p>地域を選択してください</p>
<? foreach($stations as $id => $station): ?>
<div class="station-btn text-center">
  <?= $this->Html->link($station, '/restaurants/?station='.$id, array('class' => 'btn btn-success btn-lg')) ?>
</div>
<? endforeach; ?>

</div>