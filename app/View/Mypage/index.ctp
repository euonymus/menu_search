<div class="container">


<div class="sample2">
  <h2>マイページ</h2>
  <button class="btn btn-default btn-raised btn-link"><?= $this->Html->link('パスワード変更', '/users/password') ?></button>
  <button class="btn btn-default btn-raised btn-link"><?= $this->Html->link('アカウント設定', '/users/edit') ?></button>
  <button class="btn btn-default btn-raised btn-link"><?= $this->Html->link('画像設定', '/users/icon') ?></button>
</div>



    <div class="social login">
        <h3>SNSアカウントを関連付ける</h3>
        <?php echo $this->element('opauth_login', array('callbackUrl'=>$this->Session->read('Auth.redirect'))); ?>
    </div>
</div>



