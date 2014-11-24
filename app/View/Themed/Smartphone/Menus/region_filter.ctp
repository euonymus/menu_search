<div>

  <h1>地域を絞り込む</h1>
<? $query_tags = $tags ? 'tags=' . $tags . '&': ''; ?>
<? foreach($stations as $id => $station): ?>
<div class="station-btn text-center">
   <?= $this->Menu->menuByStation($id, $station, array('class'=> 'btn btn-success btn-lg')) ?>
</div>
<? endforeach; ?>

</div>