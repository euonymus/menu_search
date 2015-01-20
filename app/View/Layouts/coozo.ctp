<!doctype html>
<html lang="ja-JP">
<head>
    <?//= $this->Html->charset(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="author" content="euonymus productions">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        <?= $title_for_layout; ?>
    </title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <?= $this->Html->script('http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') ?>
      <?= $this->Html->script('http://oss.maxcdn.com/respond/1.4.2/respond.min.js') ?>
    <![endif]-->
    <link rel="apple-touch-icon-precomposed" href="/webclip.png" />

    <?= $this->element('opengraph') ?>
    <?= $this->element('twittercards') ?>
    <?
        echo $this->Html->meta('description', $description_for_layout);
        echo $this->Html->meta('icon');

        echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
        echo $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
        echo $this->Html->css('jquery.sidr.light');
        //echo $this->Html->css('ripples.min');
        echo $this->Html->css('material-wfont.min');

        echo $this->Html->css('generic');
        if ($isSmartphone) {
          echo $this->Html->css('generic_sp');
	} else {
          echo $this->Html->css('generic_pc');
	}

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->element('mixpanel_library');
    ?>
</head>
<body<?= ($this->name == 'Pages') ? ' class="home"' : '' ?>>
    <?= $this->element('google_tagmanager') ?>

    <?= $this->element('facebook_sdk') ?>
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

    <?= $this->Html->script('//code.jquery.com/jquery-1.11.1.min.js') ?>
    <?= $this->Html->script('jquery.sidr.min') ?>
    <?= $this->element('sidrInit'); ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') ?>
    <?//= $this->Html->script('bootstrapSlideInMenu-1.0.0.min') ?>
    <?//= $this->Html->script('ripples.min') ?>
    <?//= $this->Html->script('material.min') ?>
    <?= $this->Js->writeBuffer();?>
    <?= $this->fetch('script') ?>

    <?//= $this->element('materialInit'); ?>
</body>
</html>
