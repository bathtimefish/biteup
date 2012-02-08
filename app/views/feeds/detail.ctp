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
						<li data-friend-jobkind="2" data-friend-level="1">
							<canvas width="80" height="80" class="avatarIcon"></canvas>
							<div class="activity">
								<p class="comment">
									<span><?php echo $detail['User']['username'] ?>さん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment"><?php echo $comment_cnt; ?></span><span class="otsu"><?php echo count($likes) ?></span></p>
									<p class="times"><?php echo $detail['Feed']['action_time'] ?></p>
								</div>
							</div>
<?php if($like_flg) : ?>
							<div class="commentForm">
								<?php echo $this->Form->create('Feed',array('controller' => 'feed', 'action' => 'detail','url'=>array($detail['Feed']['id']))); ?>								
								<p><?php echo $this->Form->input('message', array('type' => 'text', 'class' => 'newRegist', 'placeholder' => 'コメントをいれてあげるぽよ', 'label' => false, 'div' => false)); ?></p>
								<p class="otsukareBtn"><?php echo $form->submit('comment_btn_otsukare.png', array('alt' => 'オツカレ', 'value' => 'オツカレ', 'width' => '70', 'div' => false)); ?></p>
								<img src="img/icon_otsukare_load.png" id="otsukareLoadIcon" style="display: none">
								</form>
							</div>
<?php endif; ?>
							<div class="commentList">
								<p class="otsukareBtnSumi"><img src="img/comment_btn_otsukare_sumi.png" alt="オツカレ済！" value="オツカレ済" width="280"></p>
								<ul>
<?php				
foreach ($likes as $like) :
if ($like['Like']['message']!='') :
?>
								<li data-friend-jobkind="<?php echo $like['Like']['jobkind_id']; ?>" data-friend-level="3">
									<a href="#">
									<p class="commentAvatar"><canvas width="80" height="80"></canvas></p>
									<div class="detail">
										<h2><?php echo $like['User']['username']; ?></h2>
										<p class="text"><?php echo $like['Like']['message']; ?></p>
										<p class="times"><?php echo $like['Like']['action_time']; ?></p>
									</div>
									</a>
								</li>
<?php
endif;
endforeach;
?>
							</div>

						</li>
					</ul>
<?php
if ( $comment_cnt > 5 ) :
?>
					<p id="moreFeed">もっと読む…<span><img src="img/icon_otsukare_load.png" alt="loading"></span></p>
<?php
endif;
?>
					</div>
				</div><!-- /#friendTimeline -->
