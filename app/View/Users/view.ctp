<div class="container">
   <?= $this->element('social_buttons') ?>

   <h1><?= UserHelper::showName($user['User']) ?></h1>
   <?= $this->Html->image($user['User']['image'], array('class'=>'user-icon')) ?>

   <div class="eaten">
     <h2>食べたランチ</h2>
     <p><?= nl2br($user['User']['description']) ?></p>
   </div>
</div>
<?= $this->element('js_menu_list') ?>
