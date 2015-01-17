<? if (!empty($menu['MenuRegistrant'])): ?>
<div class="container">
  <h2>このランチを食べた人</h2>
  <div class="well">
<? foreach($menu['MenuRegistrant'] as $image):?>
   <?= $this->Html->link($this->Html->image($image['User']['image'], array('class'=>'user-icon-s')),'/users/view/'.$image['User']['id'], array('escape' => false)) ?>
<? endforeach; ?>
  </div>
</div>
<? endif; ?>