<div class="jobs form">
<?php echo $this->Form->create('Job');?>
	<fieldset>
		<legend><?php __('Add Job'); ?></legend>
	<?php
        echo $this->Form->input('user_id', array('type'=>'hidden', 'value'=>$user['User']['id']));
    ?>
    <div>Nickname: <?php echo $user['User']['username']; ?></div>
    <?php
		echo $this->Form->input('name');
		echo $this->Form->input('startdate');
		echo $this->Form->input('starttime');
		echo $this->Form->input('jobtime');
		echo $this->Form->input('jobkind_id');
		echo $this->Form->input('checkin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
