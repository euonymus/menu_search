<? if (!U::arrPrepared('Menu', $this->data) || !U::arrPrepared('name', $this->data['Menu']) || empty($this->data['Menu'])):?>
<style>
.optional-input, #close-option {
  display:none;
}
</style>
<? else: ?>
<style>
#open-option {
  display:none;
}
</style>
<? endif; ?>
<? $this->Html->scriptStart(array('inline' => false)); ?>
$('.toggle-optional-input').click(function(){
    if ($('.optional-input').css('display') == 'none') {
      $('#open-option').css('display','none');
      $('#close-option').css('display','inline');

      $('.optional-input').slideDown('fast');

      $('#MenuId').attr('required',false);
      $('#MenuName').attr('required',true);
      $('#MenuPrice').attr('required',true);
      $('#MenuTagId1').attr('required',true);
      $('#MenuTagId4').attr('required',true);
      $('#MenuTagId8').attr('required',true);
      $('#MenuTagId30').attr('required',true);
      $('#MenuTagId13').attr('required',true);
      $('#MenuTagId14').attr('required',true);
      $('#MenuTagId24').attr('required',true);
      $('#MenuTagId42').attr('required',true);
      $('#MenuTagId55').attr('required',true);
      $('#MenuTagId56').attr('required',true);
      $('#MenuTagId57').attr('required',true);
      $('#MenuTagId94').attr('required',true);
      $('#MenuTagId71').attr('required',true);
      $('#MenuTagId104').attr('required',true);
      $('#MenuTagId128').attr('required',true);
      $('#MenuTagId115').attr('required',true);
    } else {
      $('#open-option').css('display','inline');
      $('#close-option').css('display','none');

      $('.optional-input').slideUp('fast');

      $('#MenuId').attr('required',true);
      $('#MenuName').attr('required',false);
      $('#MenuPrice').attr('required',false);
      $('#MenuTagId1').attr('required',false);
      $('#MenuTagId4').attr('required',false);
      $('#MenuTagId8').attr('required',false);
      $('#MenuTagId30').attr('required',false);
      $('#MenuTagId13').attr('required',false);
      $('#MenuTagId14').attr('required',false);
      $('#MenuTagId24').attr('required',false);
      $('#MenuTagId42').attr('required',false);
      $('#MenuTagId55').attr('required',false);
      $('#MenuTagId56').attr('required',false);
      $('#MenuTagId57').attr('required',false);
      $('#MenuTagId94').attr('required',false);
      $('#MenuTagId71').attr('required',false);
      $('#MenuTagId104').attr('required',false);
      $('#MenuTagId128').attr('required',false);
      $('#MenuTagId115').attr('required',false);


      $('#MenuName').attr('value',null);
    }
});
<? $this->Html->scriptEnd();?>

<div class="container">
   <h1>食べたランチを登録<br><small><?= $restaurant['Restaurant']['name'] ?></small></h1>
<?
$formOption = array('class' => 'form-horizontal','enctype' => 'multipart/form-data', 'action' => 'upload','type' => 'post', 'url' => $this->here);
echo $this->Form->create('Menu', $formOption); ?>
      <fieldset>
         <?= $this->Form->error('image_file') ?>
         <div class="form-group">
            <div class="col-xs-2">
               <?= $this->Form->input('NoModel.image_file', array('type' => 'file', 'accept' => 'image/*',
                                            'onchange'=>"$('#NoModelImageFile').addClass('picture-taken');",
                                            'capture' => 'camera', 'label'=>false,'class'=>'camera-open')) ?>
               <?= $this->Form->hidden('NoModel.thumb') ?>
               <?= $this->Form->hidden('NoModel.horizontal') ?>
               <?= $this->Form->hidden('restaurant_id', array('value' => $restaurant['Restaurant']['id'])) ?>
            </div>
            <?= $this->Form->input('id',
					   array('class' => 'form-control',
						 'options' => $menuList,
						 'empty' => '選択してください',
						 'div' => array('class' => 'col-xs-10'),
						 'label' => 'ランチメニュー')); ?>
         </div>


	 <div id="open-option" class="toggle-optional-input"><?= UHelper::pictAddCircle() ?>ランチを新しく登録</div>
	 <div id="close-option" class="toggle-optional-input"><?= UHelper::pictRemoveCircle() ?>ランチを新しく登録</div>


         <div class="optional-input">
            <div class="form-group">
            <?= $this->Form->input('name',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-xs-8'),
				 'label' => '料理の名前')); ?>
            <?= $this->Form->input('price',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-xs-4'),
				 'min' => 0,
				 'label' => '金額')); ?>
            </div>

         <div style="font-weight:bold;">タグを選択</div>
         <div class="tag-radios row">
            <div class="tag-radio col-xs-3">
               <?= $this->Form->input('tag_id',
                                      array('type' => 'radio',
                                            'options' => $menuTagList,
                                            'separator'=> '</div><div class="tag-radio col-xs-3">',
                                            'div' => false,
                                            'label' => array('class'=>'text-center'),
                                            'legend'=>false)); ?>
            </div>
         </div>
         </div>

<? /*
         <div class="form-group">
            <?= $this->Form->input('Restaurant.name',
					   array('class' => 'form-control',
						 //'options' => $restaurantList,
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'レストラン名')); ?>
         </div>
         <?= $this->Map->place() ?>
         <?= $this->Form->error('geo') ?>
*/ ?>

         <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
               <?= $this->Form->submit('登録する', array('class'=>'btn btn-primary', 'div' => false)); ?>
            </div>
         </div>
      </fieldset>
   <?= $this->Form->end(); ?>
</div>

