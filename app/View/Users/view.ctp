<div class="container">
   <?= $this->element('social_buttons') ?>

   <h1><?= UserHelper::showName($user['User']) ?></h1>
   <div class="row">
     <div class="col-xs-4">
       <?= $this->Html->image($user['User']['image'], array('class'=>'user-icon')) ?>
     </div>
     <div class="col-xs-8">
       <p><?= nl2br($user['User']['description']) ?></p>
     </div>
   </div>

   <div class="eaten">
     <h2>食べたランチ</h2>
   </div>
</div>
<?= $this->element('js_menu_list') ?>
