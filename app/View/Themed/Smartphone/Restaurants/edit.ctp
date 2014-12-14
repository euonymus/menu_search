<div class="container">
<div class="restaurants form">
    <h1><?= UHelper::pictRestaurant(24) ?>レストラン編集</h1>

<?php 
$formOption = array('class' => 'form-horizontal');
echo $this->Form->create('Restaurant', $formOption); ?>
    <fieldset>
	<?= $this->Form->input('id') ?>
        <div class="form-group">
             <? echo $this->Form->input('name',
					   array('class' => 'form-control',
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'レストラン名')); ?>
             <? echo $this->Form->input('description',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => '説明文')); ?>
        </div>
        <div class="form-group">
             <?= $this->Form->input('Station', array('options'=>$stations,
					  'multiple' => true, 'class'=>'form-control', 'div'=>array('class'=>'col-lg-3'))) ?>
        </div>
        <br>
        <?= $this->Restaurant->map($this->data['Restaurant'], true) ?>

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <?php echo $this->Form->submit('サインアップ', array('class'=>'btn btn-success', 'div' => false)); ?>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
</div>


