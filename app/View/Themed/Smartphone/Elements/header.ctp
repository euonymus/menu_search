<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <button style="float:left;" id="simple-menu" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><?= $this->Html->image('/img/coozo_logo.png', array('height'=>'100%', 'alt'=>$site_name, 'title'=>$site_name)) ?></a>

        <?= $this->User->mypageLink() ?>

    </div>
</div>

<div id="sidr">

	<ul>
		<!--class名に"active"を指定するとボタンを押した状態を表現できます。-->
<? if ($user = $this->Session->read('Auth.User')): ?>
                <li><a href="/mypage"><?= UHelper::pictMypage() ?>マイページ</a></li>
                <li><a href="/menus/likes/refresh:1/"><?= UHelper::pictHeart() ?>お気に入りメニュー</a></li>
<? else: ?>
                <?php $callbackUrl = (isset($callbackUrl) ? $callbackUrl : Router::reverse(Router::getRequest())); ?>
                <li><?= $this->Html->link(UHelper::pictAssignment().'サインアップ', array('controller' => 'users', 'action' => 'add', '?' => array('location'=>$callbackUrl)), array('escape'=>false)); ?>
                <li><?= $this->Html->link(UHelper::pictLockOpen().'ログイン', array('controller' => 'users', 'action' => 'login', '?' => array('location'=>$callbackUrl)), array('escape'=>false)); ?>
<? endif; ?>
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
		<li><a href="/geo/init/?location=<?= urlencode('/menus/recommended/') ?>"><?= UHelper::pictThumbUp() ?>お店の逸品！！</a></li>
		<li><a href="/geo/init/?location=<?= urlencode('/menus/') ?>"><?= UHelper::pictRestaurantMenu() ?>周辺のメニュー</a></li>
		<li><a href="/menus/region/refresh:1/next:categories/"><?= UHelper::pictCafe() ?>種類でメニュー検索</a></li>
                <li><a href="/restaurants/region"><?= UHelper::pictRestaurant() ?></i>レストランを探す</a></li>


<? if ($user): ?>
        </ul>
        <ul>
        </ul>
        <ul>
        </ul>
        <ul>
                <li><?= $this->Html->link(UHelper::pictKey().'ログアウト', array('controller' => 'users', 'action' => 'logout'), array('escape'=>false)); ?></li>
<? endif; ?>
	</ul>
<? if (isset($user['role']) && ($user['role'] == 'admin')): ?>
        <ul>
            <li><a href="/menus/add"><?= UHelper::pictAddList() ?>メニュー登録</a></li>
            <li><a href="/restaurants/add"><?= UHelper::pictSettings() ?>レストラン登録</a></li>
        </ul>
<? endif; ?>
</div>
