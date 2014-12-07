<div class="container">

<ul>
<?
if ($user = $this->Session->read('Auth.User')) { $ancLetter = 'と関連付ける'; } else {$ancLetter = 'でサインイン';}
$callbackUrl = (isset($callbackUrl) ? $callbackUrl : Router::reverse(Router::getRequest()));
?>
<li><?= $this->Html->link('Facebook' . $ancLetter, array('controller' => 'users', 'action' => 'oplogin', 'facebook', '?' => array('location' => $callbackUrl))); ?></li>
<li><?= $this->Html->link('Twitter' . $ancLetter, array('controller' => 'users', 'action' => 'oplogin', 'twitter', '?' => array('location' => $callbackUrl))); ?></li>
</ul>

</div>