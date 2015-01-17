<style>
.optional-input, #close-option {
  display:none;
}
</style>
<? $this->Html->scriptStart(array('inline' => false)); ?>
$('.toggle-optional-input').click(function(){
    if ($('.optional-input').css('display') == 'none') {
      $('#open-option').css('display','none');
      $('#close-option').css('display','inline');

      $('.optional-input').slideDown('fast');
      $('#RestaurantName').attr('required',false);
      // mapがズレずに表示されるためにここでrenderする。
      gmap.render(gmap.position.coords);
    } else {
      $('#open-option').css('display','inline');
      $('#close-option').css('display','none');

      $('.optional-input').slideUp('fast');
    }
});
<? $this->Html->scriptEnd();?>


<div class="container">
   <h1>食べたランチを登録<br><small>レストラン選択</small></h1>
   
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
						 'label' => 'レストラン名(周辺)')); ?>
         </div>

	 <div id="open-option" class="toggle-optional-input"><?= UHelper::pictAddCircle() ?>レストランを新しく登録</div>
	 <div id="close-option" class="toggle-optional-input"><?= UHelper::pictRemoveCircle() ?>レストランを新しく登録</div>


         <div class="optional-input">
            <div class="form-group">
               <?= $this->Form->input('name_nolist',
					   array('class' => 'form-control',
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'レストラン名追加')); ?>
            </div>
            <div>レストランの場所をクリック</div>
            <?= $this->element('js_add_restaurants') ?>
         </div>
         <?= $this->Form->error('RestaurantGeo.latitude') ?>

         <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
               <?= $this->Form->submit('レストラン選択', array('class'=>'btn btn-primary', 'div' => false)); ?>
            </div>
         </div>
      </fieldset>
   <?= $this->Form->end(); ?>
</div>

