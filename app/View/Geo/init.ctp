<? /* Layout で Html->scriptStart() を利用するとレンダーされないため常に読み込むヘッダでupdateLocation()を行う */ ?>
<?= $this->Map->updateLocation() ?>
<?= $this->Html->image('/img/loading.gif', array('width'=>'100%')) ?>