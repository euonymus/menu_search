<!doctype html>
<html lang="ja" ng-app>
<head>
    <?//= $this->Html->charset(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="euonymus productions">

    <title>
        <?php //echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <?= $this->Html->script('html5shiv.js') ?>
      <?= $this->Html->script('respond.min.js') ?>
    <![endif]-->

    <?php
        echo $this->Html->meta('description', 'ここに何か説明を書き込む');
        echo $this->Html->meta('icon');

        echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
        echo $this->Html->css('ripples.min');
        echo $this->Html->css('material-wfont.min');

        echo $this->Html->css('generic_sp');

	echo $this->fetch('meta');
	echo $this->fetch('css');
    ?>
</head>
<body<?= ($this->name == 'Pages') ? ' class="home"' : '' ?>>
    <?= $this->element('header') ?>
    <?//= $this->element('breadcrumb') ?>
    <div id="bodyMiddle" class="row">
        <div id="mainContent" class="container">
            <?= $this->Session->flash() ?>
            <?= $this->fetch('content') ?>
　　     </div> <!-- /container -->
    </div>
    <!-- /.row -->


    <?= $this->element('footer') ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <? // removed for DebugKit.    echo $this->element('sql_dump'); ?>




    <?= $this->Html->script('//code.jquery.com/jquery-1.10.2.min.js') ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') ?>
    <?= $this->Html->script('ripples.min') ?>
    <?= $this->Html->script('material.min') ?>
    <?= $this->Html->script('//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js') ?>
    <?= $this->Js->writeBuffer();?>
    <?= $this->fetch('script') ?>
    <?= $this->element('materialInit'); ?>

</body>
</html>
