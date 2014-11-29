<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">おしながき</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
<? /*
        <form class="navbar-form navbar-left">
            <input type="text" class="form-control col-lg-8" placeholder="Search">
        </form>
*/ ?>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/menus/region"><?= UHelper::pictRestaurant() ?>メニューを探す</a></li>
            <li class="active"><a href="/restaurants/region"><?= UHelper::pictHome() ?></i>レストランを探す</a></li>
            <li class="active"><a href="/menus/add"><?= UHelper::pictAddList() ?>メニュー登録</a></li>
            <li class="active"><a href="/restaurants/add"><?= UHelper::pictSettings() ?>レストラン登録</a></li>
        </ul>
    </div>
</div>
