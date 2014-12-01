<div class="twusers form">
<?php echo $this->Form->create('Twuser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Twuser'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('screen_name');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('profile_image_url');
		echo $this->Form->input('profile_image_url_https');
		echo $this->Form->input('profile_background_image_url');
		echo $this->Form->input('profile_background_image_url_https');
		echo $this->Form->input('profile_use_background_image');
		echo $this->Form->input('profile_text_color');
		echo $this->Form->input('profile_link_color');
		echo $this->Form->input('profile_background_color');
		echo $this->Form->input('profile_sidebar_border_color');
		echo $this->Form->input('profile_sidebar_fill_color');
		echo $this->Form->input('url');
		echo $this->Form->input('profile_banner_url');
		echo $this->Form->input('protected');
		echo $this->Form->input('is_translator');
		echo $this->Form->input('verified');
		echo $this->Form->input('contributors_enabled');
		echo $this->Form->input('geo_enabled');
		echo $this->Form->input('follow_request_sent');
		echo $this->Form->input('profile_background_tile');
		echo $this->Form->input('location');
		echo $this->Form->input('lang');
		echo $this->Form->input('utc_offset');
		echo $this->Form->input('time_zone');
		echo $this->Form->input('followers_count');
		echo $this->Form->input('friends_count');
		echo $this->Form->input('listed_count');
		echo $this->Form->input('favourites_count');
		echo $this->Form->input('statuses_count');
		echo $this->Form->input('default_profile');
		echo $this->Form->input('default_profile_image');
		echo $this->Form->input('notifications');
		echo $this->Form->input('following');
		echo $this->Form->input('created_at');
		echo $this->Form->input('token');
		echo $this->Form->input('secret');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Twuser.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Twuser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Twusers'), array('action' => 'index')); ?></li>
	</ul>
</div>
