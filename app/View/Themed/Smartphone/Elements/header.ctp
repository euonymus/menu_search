<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><?= $site_name ?></a>
    </div>
</div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
<?
   // TODO: Helperに持って行く。
   // TODO: station_idでの絞り検索にも対応する。（現在のPathにstation_id絞り込みがあるかどうかで判断。
   $formOption = array('class' => 'navbar-form navbar-left','type' => 'get', 'url' => '/menus/search/');
   echo $this->Form->create('Menu', $formOption);
   echo $this->Form->input('tags', array('class' => 'form-control col-lg-8',
					 'div' => false,
					 'label' => false,
					 'placeholder' => '検索'));
   echo $this->Form->end();
?>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/menus/region"><?= UHelper::pictRestaurantMenu() ?>メニューを探す</a></li>
            <li class="active"><a href="/restaurants/region"><?= UHelper::pictRestaurant() ?></i>レストランを探す</a></li>
        </ul>

   <? /* If not logged in */ ?>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/users/login"><?= UHelper::pictLockOpen() ?>サインイン</a></li>
            <li class="active"><a href="/users/add"><?= UHelper::pictAssignment() ?>サインアップ</a></li>
        </ul>
   <? /* If logged in */ ?>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/users"><?= UHelper::pictMypage() ?>マイページ</a></li>
            <li class="active"><a href="/users/logout"><?= UHelper::pictKey() ?>サインアウト</a></li>
        </ul>
   <? /* If logged in as admin */ ?>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/menus/add"><?= UHelper::pictAddList() ?>メニュー登録</a></li>
            <li class="active"><a href="/restaurants/add"><?= UHelper::pictSettings() ?>レストラン登録</a></li>
        </ul>
    </div>
