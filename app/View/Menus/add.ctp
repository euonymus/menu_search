<div class="container">
<div class="bs-docs-section">
<div class="well bs-component">

<?php 
$formOption = array('class' => 'form-horizontal','enctype' => 'multipart/form-data', 'action' => 'upload','type' => 'post', 'url' => $this->here);
echo $this->Form->create('Menu', $formOption); ?>
	<fieldset>
		<legend>料理を登録する</legend>

        <div class="form-group">
  <div><?= $this->Html->link('レストランを新しく登録', '/restaurants/add') ?></div>
             <? echo $this->Form->input('restaurant_id',
					   array('class' => 'form-control',
						 'options' => $restaurantList,
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'レストラン')); ?>
             <? echo $this->Form->input('name',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => '料理の名前')); ?>
        </div>
        <div class="form-group">
             <? echo $this->Form->input('price',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => '金額')); ?>
        </div>
<br>
<br>
<br>
        <div class="form-group">
             <? echo $this->Form->input('description',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => '料理の説明')); ?>
        </div>
        <div class="form-group">
             <? echo $this->Form->input('remarks',
			   array('class' => 'form-control',
				 'div' => array('class' => 'col-lg-3'),
				 'label' => '備考')); ?>
        </div>
        <div class="form-group">
            <div class="col-lg-3 checkbox">
                <label>
                <? echo $this->Form->input('combo',
					   array('div' => false,
						 'label' => false)); ?> セットメニュー
                </label>
            </div>
            <div class="col-lg-3 checkbox">
                <label>
                <? echo $this->Form->input('lunch',
					   array('div' => false,
						 'label' => false)); ?> ランチ
                </label>
            </div>
            <div class="col-lg-3 checkbox">
                <label>
                <? echo $this->Form->input('dinner',
					   array('div' => false,
						 'label' => false)); ?> ディナー
                </label>
            </div>
        </div>
        <div class="form-group">
                <? echo $this->Form->input('tag_id',
					   array('class' => 'form-control',
						 'options' => $menuTagList,
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'タグ')); ?>
        </div>
        <div class="form-group">
           <div class="col-lg-6">
<? if(isset($this->data['Menu']['image'])): ?>
             <img src="<?= $this->data['Menu']['image'] ?>" class="img-thumbnail"/>
<? endif; ?>
                 <?= $this->Form->input('NoModel.image_file', array('type' => 'file', 'label'=>'','class'=>'btn btn-info')) ?>
                 <?= $this->Form->radio('NoModel.cropType', 
			  array('1' => '中央寄せ寄せ', '0' => '0,0ポイントから'),
			  array('label' => false, 'default' => '1', 'legend'=> false)) ?>
                 <br><div class="alert alert-warning"><span class="glyphicon glyphicon-info-sign"></span>プロフィール画像は 400 x 400ピクセル に縮小されます</div>
           </div>
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
