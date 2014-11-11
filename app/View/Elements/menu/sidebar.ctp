<div id="sidebar">
<div class="btn-group-vertical">
   <?= $this->Html->link(
			 '<i class="mdi-action-home" style="font-size: 20pt;"></i>Home',
			 '/menus',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
   <?= $this->Html->link(
			 '<i class="mdi-navigation-menu" style="font-size: 20pt;"></i>メニュー',
			 '/menus/list',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
   <?= $this->Html->link(
			 '<i class="mdi-maps-local-restaurant" style="font-size: 20pt;"></i>レストラン',
			 '/restaurants',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
<? /*
   <?= $this->Html->link(
			 '<i class="mdi-action-settings" style="font-size: 20pt;"></i>設定',
			 '/dgi/master',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
*/ ?>
</div>
</div>
