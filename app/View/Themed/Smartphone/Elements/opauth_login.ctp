<?php
if ($user = $this->Session->read('Auth.User')) { $ancLetter = 'と関連付ける'; } else {$ancLetter = 'でログイン';}
$callbackUrl = (isset($callbackUrl) ? $callbackUrl : Router::reverse(Router::getRequest()));
?>
<?php echo $this->Html->link($this->Html->image('/img/facebook_logo144.png', array('class'=>'sns-logo')), array('controller' => 'users', 'action' => 'oplogin', 'facebook', '?' => array('location' => $callbackUrl)),array('escape'=>false)); ?>
<?php echo $this->Html->link($this->Html->image('/img/twitter_logo144.png', array('class'=>'sns-logo')), array('controller' => 'users', 'action' => 'oplogin', 'twitter', '?' => array('location' => $callbackUrl)),array('escape'=>false)); ?>
