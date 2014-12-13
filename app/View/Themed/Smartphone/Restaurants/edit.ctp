<div class="container">
<div class="restaurants form">

    <h1><?= UHelper::pictRestaurant(24) ?>レストラン編集</h1>

<?php 
$formOption = array('class' => 'form-horizontal');
echo $this->Form->create('User', $formOption); ?>
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
        <div class="form-group">
            <div id="map" style="height:250pt"></div>
        </div>
        <?= $this->Form->input('latitude', array('id' => 'show_lat')) ?>
        <?= $this->Form->input('longitude', array('id' => 'show_lng')) ?>

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <?php echo $this->Form->submit('サインアップ', array('class'=>'btn btn-success', 'div' => false)); ?>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
</div>


<?= $this->Html->script('//maps.google.com/maps/api/js?v=3&sensor=false') ?>
<?= $this->Html->script('geoinfo') ?>
