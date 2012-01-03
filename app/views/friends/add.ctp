<div class="friends form">
<?php echo $this->Form->create('Friend');?>
	<fieldset>
		<legend><?php __('Add Friend'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('friend_id', array('type'=>'select', 'options'=>$users));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Friends', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>