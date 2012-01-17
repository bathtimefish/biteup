<?php
		$comment_cnt = 0;
		foreach ($likes as $like) {
			if ($like['Like']['message']!='')
				$comment_cnt++;
		} 
		?>
<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
<script>
		
			$(function (){
					var sl = new checkInUI();
					sl.isWorking = true; //勤務中はtrue,つまりチェックアウトが出る
					sl.init("checkInSlider");
				});
				
		</script>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>
<div class="woodFrame friendTimelineDetail">
					<div class="woodWrapper">
						<ul>
						<li>
							<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">
							<div class="activity">
								<p class="comment">
									<span><?php echo $detail['User']['username'] ?>さん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment"><?php echo $comment_cnt; ?></span><span class="otsu"><?php echo count($likes) ?></span></p>
									<p class="times"><?php echo $detail['Feed']['action_time'] ?></p>
								</div>
							</div>
						</li>
						
					</ul>
					</div>
				</div><!-- /#friendTimeline -->
<?php
		if($like_flg) {
?>
				<div class="commentForm">
					<h1>おつかれコメントを入れてあげましょう</h1>
<?php
			echo $this->Form->create('Feed',array('controller' => 'feed', 'action' => 'detail','url'=>array($detail['Feed']['id'])));
			echo $this->Form->input('message');
			echo $this->Form->submit('オツカレ！');
			echo $this->Form->end($options=null); 
		}
?>
				</div>
				
				<div class="commentList">
					<ul>
	<?php				foreach ($likes as $like) {
			if ($like['Like']['message']!='') {
?>
					<li>
						<a href="#">
						<p class="commentAvatar"><?php echo $this->Html->image('dummy/dummy_avatar.png', array('alt'=>'#')); ?></p>
						<div class="detail">
							<h2><?php echo $like['User']['username']; ?></h2>
							<p class="text"><?php echo $like['Like']['message']; ?></p>
							<p class="times"><?php echo $like['Like']['action_time']; ?></p>
						</div>
						</a>
					</li>
<?php }
} ?>
					</ul>
				</div>
				
