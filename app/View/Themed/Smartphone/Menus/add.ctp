<div class="container">
   <h1>ランチメニュー登録</h1>
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
            <?= $this->Form->input('name',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-xs-6'),
				 'label' => '料理の名前')); ?>
            <?= $this->Form->input('price',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-xs-4'),
				 'min' => 0,
				 'label' => '金額')); ?>
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

         <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
               <?= $this->Form->submit('登録する', array('class'=>'btn btn-primary', 'div' => false)); ?>
            </div>
         </div>
      </fieldset>
   <?= $this->Form->end(); ?>
</div>

