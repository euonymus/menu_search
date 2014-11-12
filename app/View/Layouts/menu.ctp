<!DOCTYPE html>
<html>
<head>
    <?//= $this->Html->charset(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="euonymus productions">

    <title>
        <?php /*echo $cakeDescription */?>:
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

        echo $this->Html->css('generic');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
    ?>
</head>
<body>
    <?= $this->element('header') ?>
    <?//= $this->element('breadcrumb') ?>
    <div id="bodyMiddle" class="row">
        <div id="mainContent" class="container">
              <?= $this->Session->flash() ?>
              <?= $this->fetch('content') ?>
　　    </div> <!-- /container -->

       <?= $this->element('sidebar') ?>
    </div>
    <!-- /.row -->

    <div id="footerContainer">
        <?= $this->element('footer') ?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <? /* removed for DebugKit.    echo $this->element('sql_dump');*/ ?>




    <?= $this->Html->script('//code.jquery.com/jquery-1.10.2.min.js') ?>
    <?= $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') ?>
    <?= $this->Html->script('ripples.min') ?>
    <?= $this->Html->script('material.min') ?>
    <?= $this->Js->writeBuffer();?>

    <?= $this->element('materialInit'); ?>
</body>
</html>
