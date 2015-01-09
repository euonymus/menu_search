<div class="container">
<div class="users form">

    <h1><?= UHelper::pictAssignment(24) ?>サインアップ</h1>

<?php 
$formOption = array('class' => 'form-horizontal');
echo $this->Form->create('User', $formOption); ?>
    <fieldset>
        <legend>Coozoアカウント登録</legend>
        <div class="form-group">
             <? echo $this->Form->input('username',
					   array('class' => 'form-control',
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'メールアドレス')); ?>
             <? echo $this->Form->input('password',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => 'パスワード')); ?>
<?php /*
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
*/ ?>
        </div>
        <div class="row">
            <div class="col-xs-4">
               <?= $this->Html->link('利用規約', '/terms', array('target' => '_blank')) ?>
            </div>
            <div class="col-xs-8">
               <?= $this->Html->link('プライバシーポリシー', '/privacy', array('target' => '_blank')) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <?php echo $this->Form->submit('サインアップ', array('class'=>'btn btn-success', 'div' => false)); ?>
            </div>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>


        ----------- または -----------

    <div class="social login">
        <h3>他のサービスでログイン</h3>
        <?php echo $this->element('opauth_login', array('callbackUrl'=>$this->Session->read('Auth.redirect'))); ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
</div>
