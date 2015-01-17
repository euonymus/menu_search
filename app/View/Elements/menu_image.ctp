<div class="menu-image-box">
   <? if (U::arrPrepared('horizontal_image', $menu['Menu']) && !is_null($menu['Menu']['horizontal_image'])) {
        $image = $menu['Menu']['horizontal_image'];
	echo  $this->Html->image($image);
      } elseif (U::arrPrepared('MenuImage', $menu) && U::arrPrepared(0, $menu['MenuImage'])) {
        $image = $menu['MenuImage'][0]['horizontal_image']; // MenuImageの最初の画像をメイン画像に。
	unset($menu['MenuImage'][0]); // MenuImageの最初の画像をリストから外す。
	echo  $this->Html->image($image);
      }
   ?>
</div>
<div class="menu-thumbnail-box">
<? foreach($menu['MenuImage'] as $image):?>
    <?= $this->Html->image($image['thumbnail'], array('class'=>'menu-image-s')) ?>
<? endforeach; ?>
</div>




