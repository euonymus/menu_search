<div class="twusers index">
	<h2><?php echo __('Twusers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('screen_name'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_image_url'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_image_url_https'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_background_image_url'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_background_image_url_https'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_use_background_image'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_text_color'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_link_color'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_background_color'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_sidebar_border_color'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_sidebar_fill_color'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_banner_url'); ?></th>
			<th><?php echo $this->Paginator->sort('protected'); ?></th>
			<th><?php echo $this->Paginator->sort('is_translator'); ?></th>
			<th><?php echo $this->Paginator->sort('verified'); ?></th>
			<th><?php echo $this->Paginator->sort('contributors_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('geo_enabled'); ?></th>
			<th><?php echo $this->Paginator->sort('follow_request_sent'); ?></th>
			<th><?php echo $this->Paginator->sort('profile_background_tile'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('lang'); ?></th>
			<th><?php echo $this->Paginator->sort('utc_offset'); ?></th>
			<th><?php echo $this->Paginator->sort('time_zone'); ?></th>
			<th><?php echo $this->Paginator->sort('followers_count'); ?></th>
			<th><?php echo $this->Paginator->sort('friends_count'); ?></th>
			<th><?php echo $this->Paginator->sort('listed_count'); ?></th>
			<th><?php echo $this->Paginator->sort('favourites_count'); ?></th>
			<th><?php echo $this->Paginator->sort('statuses_count'); ?></th>
			<th><?php echo $this->Paginator->sort('default_profile'); ?></th>
			<th><?php echo $this->Paginator->sort('default_profile_image'); ?></th>
			<th><?php echo $this->Paginator->sort('notifications'); ?></th>
			<th><?php echo $this->Paginator->sort('following'); ?></th>
			<th><?php echo $this->Paginator->sort('created_at'); ?></th>
			<th><?php echo $this->Paginator->sort('token'); ?></th>
			<th><?php echo $this->Paginator->sort('secret'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($twusers as $twuser): ?>
	<tr>
		<td><?php echo h($twuser['Twuser']['id']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['screen_name']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['name']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['description']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_image_url']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_image_url_https']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_background_image_url']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_background_image_url_https']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_use_background_image']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_text_color']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_link_color']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_background_color']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_sidebar_border_color']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_sidebar_fill_color']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['url']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_banner_url']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['protected']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['is_translator']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['verified']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['contributors_enabled']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['geo_enabled']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['follow_request_sent']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['profile_background_tile']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['location']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['lang']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['utc_offset']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['time_zone']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['followers_count']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['friends_count']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['listed_count']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['favourites_count']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['statuses_count']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['default_profile']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['default_profile_image']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['notifications']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['following']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['created_at']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['token']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['secret']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['status']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['created']); ?>&nbsp;</td>
		<td><?php echo h($twuser['Twuser']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $twuser['Twuser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $twuser['Twuser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $twuser['Twuser']['id']), array(), __('Are you sure you want to delete # %s?', $twuser['Twuser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Twuser'), array('action' => 'add')); ?></li>
	</ul>
</div>
