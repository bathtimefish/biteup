<div class="feeds index">
	<h2><?php __('Feeds');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>つぶやき</th>
	</tr>
	<tr>
		<td><?php echo $detail['Feed']['message']; ?><br />
		<?php
		echo 'いいね'.count($likes).'個';
		$comment_cnt = 0;
		foreach ($likes as $like) {
			if ($like['Like']['message']!='') {
				echo $like['Like']['message'].$like['User']['username'].'<br />';
				$comment_cnt++;
			}
			
		} 
		echo 'コメント'.$comment_cnt.'個';
		?>
		</td>
	</tr>
	<tr>
		<td>
<?php
		if($like_flg) {
			echo $this->Form->create('Feed',array('controller' => 'feed', 'action' => 'detail','url'=>array($detail['Feed']['id'])));
			echo $this->Form->input('message');
			echo $this->Form->submit('Submit');
			echo $this->Form->end($options=null); 
		}
?>

</td>
	</tr>
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
		<li><?php echo $this->Html->link(__('New Feed', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('controller' => 'jobs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('controller' => 'jobs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Likes', true), array('controller' => 'likes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Like', true), array('controller' => 'likes', 'action' => 'add')); ?> </li>
	</ul>
</div>