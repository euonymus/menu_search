<div class="container">
   <h1>Facebookアカウント</h1>

   <?= $this->element('breadcrumb') ?>

   <div class="row">
      <div class="col-xs-2">
   <?//= $this->Html->image($fbuser['Fbuser']['profile_image_url']) ?>
      </div>
      <div class="col-xs-10">
         <div>
            <?= $this->Html->link($fbuser['Fbuser']['name'], $fbuser['Fbuser']['link'], array('target' => '_blank')) ?>
         </div>
         <div>
            <?= $fbuser['Fbuser']['last_name'] ?> <?= $fbuser['Fbuser']['first_name'] ?>
         </div>
      </div>
   </div>
</div>



