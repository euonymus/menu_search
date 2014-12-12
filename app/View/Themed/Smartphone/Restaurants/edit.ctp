<div class="restaurants form">
<?php echo $this->Form->create('Restaurant'); ?>
	<fieldset>
		<legend><?php echo __('Edit Restaurant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
                echo $this->Form->input('Station', array('options'=>$stations, 'multiple' => true));
        ?>



  <div id="map" style="height:250pt"></div>
<?= $this->Form->input('latitude', array('id' => 'show_lat')) ?>
<?= $this->Form->input('longitude', array('id' => 'show_lng')) ?>

<?= $this->Html->script('//maps.google.com/maps/api/js?v=3&sensor=false') ?>
<?= $this->Html->script('geoinfo') ?>





	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Restaurant.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Restaurant.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?></li>
	</ul>
</div>
