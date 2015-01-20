<!--sidr.jsの読み込み-->
<? $this->Html->scriptStart(array('inline' => false)); ?>
$(document).ready(function() {
	$('#simple-menu').sidr();
});

<? /* TODO: remove it later, because this is only a mixpanel testing purpose */ ?>
mixpanel.track_links("#sidr a", "click nav link", {
  "referrer": document.referrer
});

<? $this->Html->scriptEnd();?>
<div id="sidr">
    <div class="nav-title text-center">アカウント</div>
    <ul>
        <!--class名に"active"を指定するとボタンを押した状態を表現できます。-->
<? if ($user = $this->Session->read('Auth.User')): ?>
        <li><a href="/mypage"><?= UHelper::pictMypage() ?>マイページ</a></li>
        <li><a href="/menus/likes/refresh:1/"><?= UHelper::pictHeart() ?>お気に入りランチメニュー</a></li>
<? else: ?>
        <?php $callbackUrl = (isset($callbackUrl) ? $callbackUrl : Router::reverse(Router::getRequest())); ?>
        <li><?= $this->Html->link(UHelper::pictAssignment().'サインアップ', array('controller' => 'users', 'action' => 'add', '?' => array('location'=>$callbackUrl)), array('escape'=>false)); ?>
        <li><?= $this->Html->link(UHelper::pictLockOpen().'ログイン', array('controller' => 'users', 'action' => 'login', '?' => array('location'=>$callbackUrl)), array('escape'=>false)); ?>
<? endif; ?>
    </ul>
    <div class="nav-title text-center">メニュー</div>
    <ul>
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
        <li><a href="/geo/init/?location=<?= urlencode('/menus/') ?>"><?= UHelper::pictRestaurantMenu() ?>周辺の人気ランチ</a></li>
        <li><a href="/menus/region/refresh:1/"><?= UHelper::pictTrain() ?>駅からランチを探す</a></li>
        <li><a href="/geo/init/?location=<?= urlencode('/menus/categories/refresh:1/') ?>"><?= UHelper::pictCafe() ?>食べたい物から探す</a></li>
<? if ($user): ?>
        <li><a href="/geo/init/?location=<?= urlencode('/menus/add_restaurant/') ?>"><?= UHelper::pictCamera() ?>ランチメニューを登録</a></li>
<? else: ?>
        <li><a href="/users/login/?location=<?= urlencode('/menus/add_restaurant/') ?>"><?= UHelper::pictCamera() ?>ランチメニューを登録</a></li>
<? endif; ?>
    </ul>
    <div class="nav-title text-center">レストラン</div>
    <ul>
        <li><a href="/geo/init/?location=<?= urlencode('/restaurants/') ?>"><?= UHelper::pictRestaurant() ?></i>周辺を検索</a></li>
        <li><a href="/restaurants/region"><?= UHelper::pictTrain() ?></i>駅から検索</a></li>
<? if ($user): ?>
    </ul>
    <div class="nav-title text-center">その他</div>
    <ul>
        <li><?= $this->Html->link(UHelper::pictKey().'ログアウト', array('controller' => 'users', 'action' => 'logout'), array('escape'=>false)); ?></li>
<? endif; ?>
    </ul>
</div>

