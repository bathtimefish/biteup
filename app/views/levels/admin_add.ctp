<div class="levels form">
<?php echo $this->Form->create('Level');?>
	<fieldset>
		<legend><?php __('Admin Add Level'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Levels', true), array('action' => 'index'));?></li>
	</ul>
</div>