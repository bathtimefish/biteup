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
								<p class="text">LEVEL9まであと<strong>4015pt</strong></p>
								<p class="point">19546 pt</p>
							</div>						
						</div><!-- /.gage -->

					</div><!-- /.profileBg -->
					
				</div><!-- /.profile -->
				
                <div class="followBtn">
                    <?php echo $this->Form->create('Friend'); ?>
                    <?php echo $this->Form->input('User.id', array('type'=>'hidden', 'value'=>$friend['User']['id'])); ?></p>
                    <p><?php echo $this->Form->submit('btn_follow.png', array('alt'=>'フォローする', 'width'=>234, 'div'=>false)); ?></p>
                    </form>
					<!-- フォローしているときはこちらを表示
					<p><small>あなたはnakashizuさんをフォローしているぽ</small></p>
					<p><input type="image" src="img/btn_unfollow.png" alt="フォロー解除する" width="234"></p>
					-->
				</div>

				<div id="timeline"  class="woodFrame">
					<div class="woodWrapper">
						<ul>
						<li data-friend-jobkind="0" data-friend-level="3">
							<a href="#">
							<!--<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">-->
							<canvas width="80" height="80" class="avatarIcon"></canvas>
							<div class="activity">
								<p class="comment">
									<span>nakashizuさん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment">2</span><span class="otsu">50</span></p>
									<p class="times">5分前</p>
								</div>
							</div>
							</a>
						</li>
						<li data-friend-jobkind="2" data-friend-level="1">
							<a href="#">
							<!--<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">-->
							<canvas width="80" height="80" class="avatarIcon"></canvas>
							<div class="activity">
								<p class="comment">
									<span>nakashizuさん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment">2</span><span class="otsu">50</span></p>
									<p class="times">5分前</p>
								</div>
							</div>
							</a>
						</li>
						<li data-friend-jobkind="3" data-friend-level="0">
							<a href="#">
							<!--<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">-->
							<canvas width="80" height="80" class="avatarIcon"></canvas>
							<div class="activity">
								<p class="comment">
									<span>nakashizuさん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment">2</span><span class="otsu">50</span></p>
									<p class="times">5分前</p>
								</div>
							</div>
							</a>
						</li>
						<li data-friend-jobkind="4" data-friend-level="1">
							<a href="#">
							<!--<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">-->
							<canvas width="80" height="80" class="avatarIcon"></canvas>
							<div class="activity">
								<p class="comment">
									<span>nakashizuさん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment">2</span><span class="otsu">50</span></p>
									<p class="times">5分前</p>
								</div>
							</div>
							</a>
						</li>
						
					</ul>
					<p id="moreFeed">もっと読む…<span><img src="img/icon_otsukare_load.png" alt="loading"></span></p>
					</div>
				</div><!-- /#friendTimeline -->
