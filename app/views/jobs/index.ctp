<div class="jobs index">
	<h2><?php __('Jobs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('startdate');?></th>
			<th><?php echo $this->Paginator->sort('starttime');?></th>
			<th><?php echo $this->Paginator->sort('jobtime');?></th>
			<th><?php echo $this->Paginator->sort('jobkind_id');?></th>
			<th><?php echo $this->Paginator->sort('checkin');?></th>
            <th><?php echo $this->Paginator->sort('checkout');?></th>
            <!--
			<th><?php echo $this->Paginator->sort('created');?></th>
            <th><?php echo $this->Paginator->sort('modified');?></th>
            -->
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($jobs as $job):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $job['Job']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($job['User']['id'], array('controller' => 'users', 'action' => 'view', $job['User']['id'])); ?>
		</td>
		<td><?php echo $job['Job']['name']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['startdate']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['starttime']; ?>&nbsp;</td>
		<td><?php echo $job['Job']['jobtime']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($job['Jobkind']['name'], array('controller' => 'jobkinds', 'action' => 'view', $job['Jobkind']['id'])); ?>
		</td>
		<td><?php echo $job['Job']['checkin']; ?>&nbsp;</td>
        <td><?php echo $job['Job']['checkout']; ?>&nbsp;</td>
        <!--
		<td><?php echo $job['Job']['created']; ?>&nbsp;</td>
        <td><?php echo $job['Job']['modified']; ?>&nbsp;</td>
        -->
		<td class="actions">
			<?php echo $this->Html->link(__('Checkin', true), array('action' => 'checkin', $job['Job']['id'])); ?>
			<?php echo $this->Html->link(__('Checkout', true), array('action' => 'checkout', $job['Job']['id'])); ?>
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $job['Job']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $job['Job']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $job['Job']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $job['Job']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Job', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobkinds', true), array('controller' => 'jobkinds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jobkind', true), array('controller' => 'jobkinds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feeds', true), array('controller' => 'feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feed', true), array('controller' => 'feeds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Likes', true), array('controller' => 'likes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Like', true), array('controller' => 'likes', 'action' => 'add')); ?> </li>
	</ul>
</div>
