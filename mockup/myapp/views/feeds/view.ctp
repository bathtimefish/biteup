<div class="feeds view">
<h2><?php  __('Feed');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($feed['User']['id'], array('controller' => 'users', 'action' => 'view', $feed['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Job'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($feed['Job']['name'], array('controller' => 'jobs', 'action' => 'view', $feed['Job']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Message'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['message']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Feed', true), array('action' => 'edit', $feed['Feed']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Feed', true), array('action' => 'delete', $feed['Feed']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $feed['Feed']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Feeds', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Likes', true), array('controller' => 'likes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Like', true), array('controller' => 'likes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Likes');?></h3>
	<?php if (!empty($feed['Like'])):?>
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
		foreach ($feed['Like'] as $like):
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
