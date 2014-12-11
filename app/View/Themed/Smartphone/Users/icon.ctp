<div class="container">
<div class="users form">

    <h1>プロフィール画像編集</h1>
<?php 
$formOption = array('class' => 'form-horizontal','enctype' => 'multipart/form-data', 'action' => 'upload','type' => 'post', 'url' => $this->here);
echo $this->Form->create('User', $formOption); ?>
	<fieldset>
		<legend>アカウント情報</legend>

	<?= $this->Form->input('id') ?>
        <div class="form-group">
           <div class="col-lg-6">
<? if(isset($this->data['User']['image'])): ?>
             <img src="<?= $this->data['User']['image'] ?>" class="img-thumbnail"/>
<? endif; ?>
                 <?= $this->Form->input('NoModel.image_file', array('type' => 'file', 'accept' => 'image/*',
							    'capture' => 'camera', 'label'=>'','class'=>'btn btn-info')) ?>
                 <?= $this->Form->radio('NoModel.cropType', 
			  array('1' => '中央寄せ寄せ', '0' => '0,0ポイントから'),
			  array('label' => false, 'default' => '1', 'legend'=> false)) ?>
                 <br><div class="alert alert-warning"><span class="glyphicon glyphicon-info-sign"></span>プロフィール画像は 400 x 400ピクセル に縮小されます</div>
           </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <?php echo $this->Form->submit('送信', array('class'=>'btn btn-success', 'div' => false)); ?>
            </div>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>

</div>
</div>


