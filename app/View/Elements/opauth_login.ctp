<?
if ($user = $this->Session->read('Auth.User')) { $ancLetter = 'と関連付ける'; } else {$ancLetter = 'でログイン';}
$callbackUrl = (isset($callbackUrl) ? $callbackUrl : Router::reverse(Router::getRequest()));
?>
<? if (!$this->User->hasFbuser()): ?>
   <?= $this->Html->link($this->Html->image('/img/facebook_logo144.png', array('class'=>'sns-logo')), array('controller' => 'users', 'action' => 'oplogin', 'facebook', '?' => array('location' => $callbackUrl)),array('escape'=>false)); ?>
<? else: ?>
   <?= $this->Html->link($this->Html->image('/img/facebook_logo144.png', array('class'=>'sns-logo')), array('controller' => 'users', 'action' => 'facebook'),array('escape'=>false)); ?>
<? endif; ?>

<? if (!$this->User->hasTwuser()): ?>
   <?= $this->Html->link($this->Html->image('/img/twitter_logo144.png', array('class'=>'sns-logo')), array('controller' => 'users', 'action' => 'oplogin', 'twitter', '?' => array('location' => $callbackUrl)),array('escape'=>false)); ?>
<? else: ?>
   <?= $this->Html->link($this->Html->image('/img/twitter_logo144.png', array('class'=>'sns-logo')), array('controller' => 'users', 'action' => 'twitter'),array('escape'=>false)); ?>
<? endif; ?>

