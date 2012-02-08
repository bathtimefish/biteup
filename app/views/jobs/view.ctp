<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('cal_ui', false);?>
<script>
window.onload = function (){
    var ev = "touchstart"; //touchstart
    $("#biteCalCall").bind(ev, showCalendar);
    function showCalendar(){
        $("#biteCalCall").unbind(ev);
        var cal = new dhCalUI("biteCalCall","biteCalendar");
        $(cal).bind("complete", function (e){
            $("#biteCalCall").bind(ev, showCalendar);
        });
    };
}
</script>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>
<div id="registration_edit">
     <?php echo $this->Form->create('Job');?>
    	<div class="woodFrame registFrame">
            <h1><?php echo $this->Html->image('regist_title_select.png', array('alt'=>'バイト先を選ぶ', 'width'=>298, 'height'=>54)); ?></h1>
			<div class="woodWrapper">
				<dl>
					<dt>今までのバイト先から選ぶ</dt>
					<dd>
						<select name="company" class="selectWorks">
							<option value="-">▼えらんでぽ</option>
							<option value="ヨドバシカメラ">ヨドバシカメラ</option>
							<option value="ビックカメラ">ビックカメラ</option>
						</select>
					</dd>
					<dt>新しいバイト先を追加する</dt>
                    <dd><?php echo $this->Form->input('name', array('type'=>'text', 'div'=>false, 'label'=>false, 'placeholder'=>'新しいバイト先をいれてぽ', 'class'=>'newRegist')); ?></dd>
					<dd><input type="text" placeholder="新しいバイト先を入れてぽ" class="newRegist"></dd>
					<dt>バイト先のジャンルを選ぶ</dt>
					<dd>
						<select name="job" class="selectWorks">
							<option value="-">▼ジャンルをえらんでぽ</option>
							<option value="力仕事・労働">力仕事・労働</option>
							<option value="オフィスワーク">オフィスワーク</option>
						</select>
					</dd>
				</dl>
			</div>
		</div>

				<div class="woodFrame registFrame">
				<h1><img src="img/regist_title_date.png" alt="日時を入れてぽ" width="298" height="54"></h1>
					<div class="woodWrapper">
					<dl>
						<dt>カレンダーから日付を選ぶ</dt>
						<dd id="biteCalCall" class="calender">2月10日</dd>
						<dd id="biteCalendar"></dd>
						<dt>バイトの開始時刻と時間を選ぶ</dt>
						<dd>
							<div class="time start"><em>10</em><em>00</em></div>から
							<div class="time while"><em>5</em>時間<em>00</em>分</div>
						</dd>
					</dl>
					</div>
				</div>
				
				<p class="alC"><a href="#"><img src="img/btn_edit.png" alt="編集する" width="206" height="60"></a></p>
				<p class="alC"><a href="#"><img src="img/btn_deletebite.png" alt="予定を削除する" width="144" height="33"></a></p>
					
				</form>
			</div><!-- /#registration -->	




<div class="jobs view">
<h2><?php  __('Job');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($job['User']['id'], array('controller' => 'users', 'action' => 'view', $job['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Startdate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['startdate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Starttime'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['starttime']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Jobtime'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['jobtime']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Jobkind'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($job['Jobkind']['name'], array('controller' => 'jobkinds', 'action' => 'view', $job['Jobkind']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Checkin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['checkin']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $job['Job']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Job', true), array('action' => 'edit', $job['Job']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Job', true), array('action' => 'delete', $job['Job']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $job['Job']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job', true), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php __('Related Feeds');?></h3>
	<?php if (!empty($job['Feed'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Job Id'); ?></th>
		<th><?php __('Message'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($job['Feed'] as $feed):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $feed['id'];?></td>
			<td><?php echo $feed['user_id'];?></td>
			<td><?php echo $feed['job_id'];?></td>
			<td><?php echo $feed['message'];?></td>
			<td><?php echo $feed['created'];?></td>
			<td><?php echo $feed['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'feeds', 'action' => 'view', $feed['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'feeds', 'action' => 'edit', $feed['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'feeds', 'action' => 'delete', $feed['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $feed['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Feed', true), array('controller' => 'feeds', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Likes');?></h3>
	<?php if (!empty($job['Like'])):?>
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
		foreach ($job['Like'] as $like):
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
