<p class="description">地域を選択してください</p>
<? foreach($stations as $id => $station): ?>
    <div class="station-btn text-center">
<?
   $options = array('class' => 'btn btn-success btn-lg');
   if (isset($isRestaurant)) $options['isRestaurant'] = $isRestaurant;
?>
      <?= $this->Menu->linkStation($id, $station, $options) ?>
    </div>
<? endforeach; ?>