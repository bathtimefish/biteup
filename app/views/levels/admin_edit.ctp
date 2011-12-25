<div class="levels form">
<?php echo $this->Form->create('Level');?>
	<fieldset>
		<legend><?php __('Admin Edit Level'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('level');
		echo $this->Form->input('name');
		echo $this->Form->input('limit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Level.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Level.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Levels', true), array('action' => 'index'));?></li>
	</ul>
</div>