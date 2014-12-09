<div class="container">
<div class="users form">

    <h1>アカウント情報変更</h1>

<?php 
$formOption = array('class' => 'form-horizontal');
echo $this->Form->create('User', $formOption); ?>
	<fieldset>
		<legend>アカウント情報</legend>


	<?= $this->Form->input('id') ?>
        <div class="form-group">
            <label for="UserNickname" class="col-xs-4 control-label">ニックネーム</label>
                <?= $this->Form->input('nickname',
			       array('class' => 'form-control',
				     'div' => array('class' => 'col-xs-8'),
				     'label' => false)); ?>
        </div>
        <div class="form-group">
            <label for="UserLastName" class="col-xs-3 control-label">名前</label>
                <?= $this->Form->input('last_name',
			       array('class' => 'form-control',
				     'div' => array('class' => 'col-xs-4'),
				     'label' => false)); ?>
                <?= $this->Form->input('first_name',
			       array('class' => 'form-control',
				     'div' => array('class' => 'col-xs-4'),
				     'label' => false)); ?>
        </div>
        <div class="form-group">
            <label for="UserDescription" class="col-xs-3 control-label">自己紹介</label>
                <?= $this->Form->input('description',
			       array('class' => 'form-control',
				     'div' => array('class' => 'col-xs-9'),
				     'label' => false)); ?>
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
