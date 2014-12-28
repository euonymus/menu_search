<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <button style="float:left;" id="simple-menu" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><?= $this->Html->image('/img/coozo_logo.png', array('height'=>'100%', 'alt'=>$site_name, 'title'=>$site_name)) ?></a>
        <div class="text-right">

<? if ($this->User->loggedIn()): ?>
        <div style="float:right;margin:10px 10px 0px 10px;"><a href="/geo/init/?location=<?= urlencode('/menus/add/') ?>"><?= UHelper::pictCamera('23pt') ?></a></div>
<? else: ?>
        <div style="float:right;margin:10px 10px 0px 10px;"><a href="/users/login/?location=<?= urlencode('/menus/add/') ?>"><?= UHelper::pictCamera('23pt') ?></a></div>
<? endif; ?>

            <?= $this->User->mypageLink() ?>
        </div>

    </div>

</div>



