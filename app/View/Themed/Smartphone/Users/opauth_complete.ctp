<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array('url' => '/users/opauth_complete/')); ?>
    <fieldset>
        <legend><?php echo __('Please enter your email'); ?></legend>
        <?php echo $this->Form->input('username', array('label' => 'email')); ?>
    </fieldset>
<?php echo $this->Form->end(__('Save')); ?>
</div>
