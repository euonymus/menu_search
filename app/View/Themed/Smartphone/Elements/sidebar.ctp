<div id="sidebar">
<div class="btn-group-vertical">
   <?= $this->Html->link(
			 '<i class="mdi-action-search" style="font-size: 20pt;"></i>メニュー検索',
			 '/menus',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
   <?= $this->Html->link(
			 '<i class="mdi-maps-local-restaurant" style="font-size: 20pt;"></i>メニュー',
			 '/menus/list',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
   <?= $this->Html->link(
			 '<i class="mdi-action-home" style="font-size: 20pt;"></i>レストラン',
			 '/restaurants',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
   <?= $this->Html->link(
			 '<i class="mdi-action-assignment" style="font-size: 20pt;"></i>メニュー登録',
			 '/menus/add',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
<? /*
   <?= $this->Html->link(
			 '<i class="mdi-action-settings" style="font-size: 20pt;"></i>設定',
			 '/dgi/master',
			 array('class' => 'btn btn-default', 'escape' => false)) ?>
*/ ?>
</div>
</div>
