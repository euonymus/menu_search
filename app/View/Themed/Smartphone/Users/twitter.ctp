<div class="container">
   <div class="sample2">
      <h1>Twitterアカウント</h1>

      <?= $this->element('breadcrumb') ?>

      <div class="row">
         <div class="col-xs-2">
            <?= $this->Html->image($twuser['Twuser']['profile_image_url']) ?>
         </div>
         <div class="col-xs-10">
            <div>
               <?= $this->Html->link('@'.$twuser['Twuser']['screen_name'],
                     'https://twitter.com/'.$twuser['Twuser']['screen_name'], array('target' => '_blank')) ?>
            </div>
            <div>
               <?= $twuser['Twuser']['name'] ?>
            </div>
         </div>
         <br>
         <br>
         <br>
         <div class="col-xs-12">
            <div>
               <?= $twuser['Twuser']['description'] ?>
            </div>
            <br>
            <div>
               URL: <?= $this->Html->link('Webページ', $twuser['Twuser']['url'], array('target' => '_blank')) ?>
            </div>
         </div>
      </div>
   </div>
</div>



