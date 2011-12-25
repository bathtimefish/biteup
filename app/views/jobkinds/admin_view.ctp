<div class="jobkinds view">
<h2><?php  __('Jobkind');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $jobkind['Jobkind']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $jobkind['Jobkind']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $jobkind['Jobkind']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $jobkind['Jobkind']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Jobkind', true), array('action' => 'edit', $jobkind['Jobkind']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Jobkind', true), array('action' => 'delete', $jobkind['Jobkind']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $jobkind['Jobkind']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobkinds', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jobkind', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Likes', true), array('controller' => 'likes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Like', true), array('controller' => 'likes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Jobs');?></h3>
	<?php if (!empty($jobkind['Job'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Startdate'); ?></th>
		<th><?php __('Starttime'); ?></th>
		<th><?php __('Jobtime'); ?></th>
		<th><?php __('Jobkind Id'); ?></th>
		<th><?php __('Checkin'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($jobkind['Job'] as $job):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $job['id'];?></td>
			<td><?php echo $job['user_id'];?></td>
			<td><?php echo $job['name'];?></td>
			<td><?php echo $job['startdate'];?></td>
			<td><?php echo $job['starttime'];?></td>
			<td><?php echo $job['jobtime'];?></td>
			<td><?php echo $job['jobkind_id'];?></td>
			<td><?php echo $job['checkin'];?></td>
			<td><?php echo $job['created'];?></td>
			<td><?php echo $job['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'jobs', 'action' => 'view', $job['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'jobs', 'action' => 'edit', $job['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'jobs', 'action' => 'delete', $job['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $job['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Likes');?></h3>
	<?php if (!empty($jobkind['Like'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Friend Id'); ?></th>
		<th><?php __('Job Id'); ?></th>
		<th><?php __('Jobkind Id'); ?></th>
		<th><?php __('Feed Id'); ?></th>
		<th><?php __('Point'); ?></th>
		<th><?php __('Message'); ?></th>
		<th><?php __('From'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($jobkind['Like'] as $like):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $like['id'];?></td>
			<td><?php echo $like['user_id'];?></td>
			<td><?php echo $like['friend_id'];?></td>
			<td><?php echo $like['job_id'];?></td>
			<td><?php echo $like['jobkind_id'];?></td>
			<td><?php echo $like['feed_id'];?></td>
			<td><?php echo $like['point'];?></td>
			<td><?php echo $like['message'];?></td>
			<td><?php echo $like['from'];?></td>
			<td><?php echo $like['created'];?></td>
			<td><?php echo $like['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'likes', 'action' => 'view', $like['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'likes', 'action' => 'edit', $like['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'likes', 'action' => 'delete', $like['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $like['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Like', true), array('controller' => 'likes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
