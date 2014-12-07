<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <button style="float:left;" id="simple-menu" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><?= $this->Html->image('/img/coozo_logo.png', array('height'=>'100%', 'alt'=>$site_name, 'title'=>$site_name)) ?></a>
    </div>
</div>
 
<div id="sidr">
	<ul>
		<!--class名に"active"を指定するとボタンを押した状態を表現できます。-->
		<li><?
   // TODO: Helperに持って行く。
   // TODO: station_idでの絞り検索にも対応する。（現在のPathにstation_id絞り込みがあるかどうかで判断。
   $formOption = array('class' => 'navbar-form navbar-left','type' => 'get', 'url' => '/menus/');
   echo $this->Form->create('Menu', $formOption);
   echo $this->Form->input('tags', array('class' => 'form-control col-lg-8',
					 'div' => false,
					 'label' => false,
					 'placeholder' => '検索'));
   echo $this->Form->end();
?></li>
		<li><a href="/menus/region"><?= UHelper::pictRestaurantMenu() ?>メニューを探す</a></li>
                <li><a href="/restaurants/region"><?= UHelper::pictRestaurant() ?></i>レストランを探す</a></li>


<? if ($user = $this->Session->read('Auth.User')): ?>
                <li><a href="/mypage"><?= UHelper::pictMypage() ?>マイページ</a></li>
                <li><?= $this->Html->link(UHelper::pictKey().'サインアウト', array('controller' => 'users', 'action' => 'logout'), array('escape'=>false)); ?></li>
<? else: ?>
<?
if ($user = $this->Session->read('Auth.User')) { $ancLetter = 'と関連付ける'; } else {$ancLetter = 'でサインイン';}
$callbackUrl = (isset($callbackUrl) ? $callbackUrl : Router::reverse(Router::getRequest()));
?>
                <li><?= $this->Html->link('Facebook' . $ancLetter, array('controller' => 'users', 'action' => 'oplogin', 'facebook', '?' => array('location' => $callbackUrl))); ?></li>
                <li><?= $this->Html->link('Twitter' . $ancLetter, array('controller' => 'users', 'action' => 'oplogin', 'twitter', '?' => array('location' => $callbackUrl))); ?></li>
                <li><?= $this->Html->link(UHelper::pictLockOpen().'サインイン', array('controller' => 'users', 'action' => 'login'), array('escape'=>false)); ?>
                <li><?= $this->Html->link(UHelper::pictAssignment().'サインアップ', array('controller' => 'users', 'action' => 'add'), array('escape'=>false)); ?>
<? endif; ?>
	</ul>
   <? // If logged in as admin  ?>
        <ul>
            <li><a href="/menus/add"><?= UHelper::pictAddList() ?>メニュー登録</a></li>
            <li><a href="/restaurants/add"><?= UHelper::pictSettings() ?>レストラン登録</a></li>
        </ul>
</div>
