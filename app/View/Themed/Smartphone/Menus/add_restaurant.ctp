<style>
.optional-input {
  display:none;
}
</style>
<? $this->Html->scriptStart(array('inline' => false)); ?>
$('.open-optional-input').click(function(){
    if ($('.optional-input').css('display') == 'none') {
      $('.optional-input').slideDown('fast');
      $('#RestaurantName').attr('required',false);
    } else {
      $('.optional-input').slideUp('fast');
    }
});
<? $this->Html->scriptEnd();?>


<div class="container">
   <h1>ランチメニュー登録<br><small>レストラン選択</small></h1>
   
<?
$formOption = array('class' => 'form-horizontal','type' => 'post', 'url' => $this->here);
echo $this->Form->create('Restaurant', $formOption); ?>
      <fieldset>
         <?= $this->Form->error('image_file') ?>

         <div class="form-group">
            <?= $this->Form->input('name',
					   array('class' => 'form-control',
						 'options' => $restaurantList,
						 'empty' => '選択してください',
						 'div' => array('class' => 'col-xs-12'),
						 'label' => 'レストラン名')); ?>
         </div>

	 <div class="open-optional-input"><?= UHelper::pictAddBox() ?>レストランを新しく登録</div>


         <div class="optional-input">
         <div class="form-group">
            <?= $this->Form->input('name_nolist',
					   array('class' => 'form-control',
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'レストラン名追加')); ?>
         </div>
         <?= $this->element('js_add_restaurants') ?>
         </div>

         <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
               <?= $this->Form->submit('レストラン選択', array('class'=>'btn btn-primary', 'div' => false)); ?>
            </div>
         </div>
      </fieldset>
   <?= $this->Form->end(); ?>
</div>

