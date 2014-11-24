<div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?= $this->Html->link('Home', '/', array('class' => 'navbar-brand')) ?>
      </div>
      <div class="navbar-collapse collapse">
   <? /*if ($this->User->isLogin()): ?>
        <ul class="nav navbar-nav">
          <? foreach(UHelper::$nav as $key => $val): ?>
          <li class="<?= $this->U->addActive($val['qualifieds']) ?>"><?= $this->Html->link($val['show'],$val['path']) ?></li>
          <? endforeach; ?>
        </ul>
   <? endif;*/ ?>
        <ul class="nav navbar-nav navbar-right">
          <li><?//= $this->User->link() ?></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</div>
