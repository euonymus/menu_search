<div id="header">
   <div id="simple-menu" class="header-toggle"></div>
   <div class="header-body">
      <a class="site-logo-link" href="/">
         <?= $this->Html->image('/img/coozo_logo.png', array('alt'=>$site_name, 'title'=>$site_name, 'class'=>'site-logo')) ?>
      </a>
   </div>
   <div class="header-add center">
<? if ($this->User->loggedIn()): ?>
     <a href="/geo/init/?location=<?= urlencode('/menus/add_restaurant/') ?>"><?= $this->Html->image('/img/menu_plus.gif', array('class'=>'menu-plus')) ?><?//= UHelper::pictAddBox('23pt') ?></a>
<? else: ?>
     <a href="/users/login/?location=<?= urlencode('/menus/add_restaurant/') ?>"><?= $this->Html->image('/img/menu_plus.gif', array('class'=>'menu-plus')) ?><?//= UHelper::pictAddBox('23pt') ?></a>
<? endif; ?>
   </div>
   <div class="header-user">
      <?= $this->User->mypageLink() ?>
   </div>
   <div class="clear"></div>
</div>
<div id="dummy-header"></div>

<? /*
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <button style="float:left;" id="simple-menu" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
<? // MEMO: height:120% はとりあえずで対応してるので後でちゃんとケアする ?>
        <a class="navbar-brand" href="/"><?= $this->Html->image('/img/coozo_logo.png', array('height'=>'120%', 'alt'=>$site_name, 'title'=>$site_name)) ?></a>
        <div class="text-right">

<? if ($this->User->loggedIn()): ?>
        <div style="float:right;margin:10px 10px 0px 10px;"><a href="/geo/init/?location=<?= urlencode('/menus/add/') ?>"><?= UHelper::pictAddBox('23pt') ?></a></div>
<? else: ?>
        <div style="float:right;margin:10px 10px 0px 10px;"><a href="/users/login/?location=<?= urlencode('/menus/add/') ?>"><?= UHelper::pictAddBox('23pt') ?></a></div>
<? endif; ?>

            <?= $this->User->mypageLink() ?>
        </div>

    </div>

</div>
*/ ?>