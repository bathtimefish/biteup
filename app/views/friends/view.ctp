<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('charactor', false);?>
<?php echo $this->Javascript->link('sync', false);?>

		<script>
		$(function (){
				
				Sync.once( 9, function (res){
						var total = res.totalPoint;
						var level = res.level;
						var jobKind = res.jobkind;
						//もしかしたら要らないかも、、、
						//console.log(total);
					});
				
			});
        </script>

<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>

				<div class="profile">
                    <h1><?php echo $friend['User']['username'] ?></h1>
					<p class="profileAvatar"><!--<img src="img/dummy/dummy_profile.jpg" alt width="320" height="175">-->
					
					<script>
						var s = Charactor.getImage("free", 2);
						document.write(s);
					</script>
					
					</p>
					<div class="profileBg">
						<div class="profileDetail">
							<div class="profileLevel">
                                <h2><?php echo $level['Level']['name']; ?><span><?php echo $jobkind['Jobkind']['name'] ?></span></h2>
								<p class="level"><?php echo $friend['User']['current_level'] ?></p>
							</div>
							<ul class="profileCount">
                                <li class="otsukare"><?php echo $likecnt; ?></li>
                                <li class="checkout"><?php echo $checkoutcnt; ?></li>
							</ul>
						</div><!-- /.profileDetail -->
						<div class="pointGage">
							<p class="meter"><span></span></p>
                            <div class="gage">
                                <!-- 未実装 -->
								<p class="text">LEVEL9まであと<strong>4015pt</strong></p>
								<p class="point">19546 pt</p>
                                <!-- 未実装 -->
							</div>
						</div><!-- /.gage -->

					</div><!-- /.profileBg -->
					
				</div><!-- /.profile -->
				
                <div class="followBtn">
                    <?php echo $this->Form->create('Friend', array('action'=>'view'.DS.$friend['User']['id'])); ?>
                    <?php echo $this->Form->input('Friend.friend_id', array('type'=>'hidden', 'value'=>$friend['User']['id'])); ?></p>
                    <?php if($followed) { ?>
                        <?php echo $this->Form->input('Friend.action', array('type'=>'hidden', 'value'=>'unfollow')); ?></p>
					    <p><small>あなたはnakashizuさんをフォローしているぽ</small></p>
                        <p><?php echo $this->Form->submit('btn_unfollow.png', array('alt'=>'アンフォロー', 'width'=>234, 'div'=>false)); ?></p>
                    <?php } else { ?>
                        <?php echo $this->Form->input('Friend.action', array('type'=>'hidden', 'value'=>'follow')); ?></p>
                        <p><?php echo $this->Form->submit('btn_follow.png', array('alt'=>'フォローする', 'width'=>234, 'div'=>false)); ?></p>
                    <?php } ?>
                    </form>
				</div>

				<div id="timeline"  class="woodFrame">
					<div class="woodWrapper">
                    <?php if(!empty($feeds)) { // Friend Timeline Loop ?>
						<ul>
                        <?php foreach($feeds as $feed) { ?>
                        <li data-friend-jobkind="<?php echo $feed['User']['current_jobkind_id']; ?>" data-friend-level="<?php echo $feed['User']['current_jobkind_id']; ?>">
							<a href="<?php echo $webroot; ?>feeds/detail/<?php echo $feed['Feed']['id']; ?>">
							<canvas width="80" height="80" class="avatarIcon"></canvas>
							<div class="activity">
								<p class="comment">
									<span><?php echo $feed['User']['username']; ?>さん</span>
                                    <?php echo $feed['Feed']['message']; ?>
								</p>
								<div class="footer">
                                    <p class="icon"><span class="comment"><?php echo $feed['Like']['comments']; ?></span>
                                    <span class="otsu"><?php echo $feed['Like']['likes']; ?></span></p>
									<p class="times"><?php echo $feed['Feed']['created']; ?></p>
								</div>
							</div>
							</a>
                        </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
					<!-- p id="moreFeed">もっと読む…<span><img src="img/icon_otsukare_load.png" alt="loading"></span></p -->
					</div>
				</div><!-- /#friendTimeline -->
