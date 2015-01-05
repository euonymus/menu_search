<style>
div#map {
 height:400pt;
}
</style>
<?//= $this->Map->map(true, 'RestaurantGeo') ?>
<?= $this->Map->place() ?>
         <div class="form-group">
            <?= $this->Form->input('Restaurant.name',
					   array('class' => 'form-control',
						 //'options' => $restaurantList,
						 'div' => array('class' => 'col-lg-3'),
						 'label' => 'レストラン名')); ?>
         </div>
