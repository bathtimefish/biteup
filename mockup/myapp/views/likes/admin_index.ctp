<div class="likes index">
	<h2><?php __('Likes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('friend_id');?></th>
			<th><?php echo $this->Paginator->sort('job_id');?></th>
			<th><?php echo $this->Paginator->sort('jobkind_id');?></th>
			<th><?php echo $this->Paginator->sort('feed_id');?></th>
			<th><?php echo $this->Paginator->sort('point');?></th>
			<th><?php echo $this->Paginator->sort('message');?></th>
			<th><?php echo $this->Paginator->sort('from');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($likes as $like):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $like['Like']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($like['User']['id'], array('controller' => 'users', 'action' => 'view', $like['User']['id'])); ?>
		</td>
		<td><?php echo $like['Like']['friend_id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($like['Job']['name'], array('controller' => 'jobs', 'action' => 'view', $like['Job']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($like['Jobkind']['name'], array('controller' => 'jobkinds', 'action' => 'view', $like['Jobkind']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($like['Feed']['id'], array('controller' => 'feeds', 'action' => 'view', $like['Feed']['id'])); ?>
		</td>
		<td><?php echo $like['Like']['point']; ?>&nbsp;</td>
		<td><?php echo $like['Like']['message']; ?>&nbsp;</td>
		<td><?php echo $like['Like']['from']; ?>&nbsp;</td>
		<td><?php echo $like['Like']['created']; ?>&nbsp;</td>
		<td><?php echo $like['Like']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $like['Like']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $like['Like']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $like['Like']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $like['Like']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Like', true), array('action' => 'add')); ?></li>
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