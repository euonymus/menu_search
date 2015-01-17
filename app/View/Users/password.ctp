<div class="container">
<div class="users form">

    <h1>パスワード変更</h1>

<?php 
$formOption = array('class' => 'form-horizontal');
echo $this->Form->create('User', $formOption); ?>
    <fieldset>
        <legend>新しいパスワードを入力してください。</legend>
             <? echo $this->Form->input('password',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => 'パスワード')); ?>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <?php echo $this->Form->submit('送信', array('class'=>'btn btn-success', 'div' => false)); ?>
            </div>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>

</div>
</div>