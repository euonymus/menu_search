<div class="home">
    <div class="lead">今日のお昼は<br>何食べよう…</div>

    <h2>地域を選択してください</h2>
<? foreach($stations as $id => $station): ?>
    <div class="station-btn text-center">
      <?= $this->Html->link($station, '/menus/?station='.$id, array('class' => 'btn btn-success btn-lg')) ?>
    </div>
<? endforeach; ?>

</div>