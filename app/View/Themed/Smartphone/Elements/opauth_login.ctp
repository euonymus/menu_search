<?php
if ($user = $this->Session->read('Auth.User')) { $ancLetter = 'と関連付ける'; } else {$ancLetter = 'でログイン';}
$callbackUrl = (isset($callbackUrl) ? $callbackUrl : Router::reverse(Router::getRequest()));
?>
<ul>
<li><?php echo $this->Html->link('Twitter' . $ancLetter, array('controller' => 'users', 'action' => 'oplogin', 'twitter', '?' => array('location' => $callbackUrl))); ?>
<li><?php echo $this->Html->link('Facebook' . $ancLetter, array('controller' => 'users', 'action' => 'oplogin', 'facebook', '?' => array('location' => $callbackUrl))); ?>
</ul>
