<div class="likes form">
<?php echo $this->Form->create('Like');?>
	<fieldset>
		<legend><?php __('Admin Add Like'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('friend_id');
		echo $this->Form->input('job_id');
		echo $this->Form->input('jobkind_id');
		echo $this->Form->input('feed_id');
		echo $this->Form->input('point');
		echo $this->Form->input('message');
		echo $this->Form->input('from');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Likes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobkinds', true), array('controller' => 'jobkinds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jobkind', true), array('controller' => 'jobkinds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feeds', true), array('controller' => 'feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed', true), array('controller' => 'feeds', 'action' => 'add')); ?> </li>
	</ul>
</div>