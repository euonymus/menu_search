<div class="container">
<div class="bs-docs-section">
<div class="well bs-component">
<?php 
$formOption = array('class' => 'form-horizontal','enctype' => 'multipart/form-data', 'action' => 'upload','type' => 'post', 'url' => $this->here);
echo $this->Form->create('Menu', $formOption); ?>
	<fieldset>
		<legend>料理を登録する</legend>

        <div class="form-group">
           <div class="col-lg-6">
                 <?= $this->Form->input('NoModel.image_file', array('type' => 'file', 'accept' => 'image/*',
							    'capture' => 'camera', 'label'=>'写真','class'=>'btn btn-info')) ?>
           </div>
        </div>
        <div class="form-group">

             <? echo $this->Form->input('Restaurant.name',
					   array('class' => 'form-control',
						 'options' => $restaurantList,
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'レストラン')); ?>
             <? echo $this->Form->input('name',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => '料理の名前')); ?>
        </div>


<?= $this->Map->place() ?>




        <div class="form-group">
             <? echo $this->Form->input('price',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => '金額')); ?>
        </div>
        <div class="form-group">
                <? echo $this->Form->input('tag_id',
					   array('class' => 'form-control',
						 'options' => $menuTagList,
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'タグ')); ?>
        </div>

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <?php echo $this->Form->submit('登録する', array('class'=>'btn btn-primary', 'div' => false)); ?>
            </div>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
	</ul>
</div>
