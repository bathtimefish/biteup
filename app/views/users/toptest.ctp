<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no"><!---->
        <title>トップページ</title>
        <?php echo $this->Javascript->link('jquery-1.7.min');?>

		<!-- ここから、サーバに吐き出してもらいたいscript -->
		<script>
			var userData = { rows: [ {userName:"nakashizu",userID:123456}] };
		</script>
		<!-- / ここから、サーバに吐き出してもらいたいscript -->

        <?php echo $this->Javascript->link('global');?>
        <?php echo $this->Javascript->link('jquery.subwindow');?>
        <?php echo $this->Javascript->link('checkin_ui');?>
		<script>
		
			$(function (){
					var sl = new checkInUI();
					sl.isWorking = true; //勤務中はtrue,つまりチェックアウトが出る
					sl.init("checkInSlider");
					
					$.fn.subwindow.open("alert/sending.html", {"filter":"#target"}, 200,200);
					/*$(".profileBtn").click(function (e){
						e.preventDefault();
							
						})*/
					
				});
				
		</script>
		
        <?php echo $this->Html->css('style', 'stylesheet', array('inline'=>true)); ?>
        <?php echo $this->Html->css('jquery.subwindow', 'stylesheet', array('inline'=>true)); ?>
	</head>
	
	<body>
	
		<div id="container">
			<div class="containerInner">
				<header>
                    <span class="profileBtn">
                        <?php echo $this->Html->link($this->Html->image('header_btn_profile.png', array('alt'=>'MyProfile')), array('action' => 'edit', $userid), array('escape' => false));?>
                    </span>
					<nav>
						<ul>
                            <li><?php echo $this->Html->link($this->Html->image('header_btn_list.png', array('alt'=>'予定リスト')), array('controller' => 'jobs', 'action' => 'index'), array('escape' => false));?></li>
                            <li><?php echo $this->Html->link($this->Html->image('header_btn_regist.png', array('alt'=>'バイト予定登録')), array('controller' => 'jobs', 'action' => 'add'), array('escape' => false));?></li>
                            <li><?php echo $this->Html->link($this->Html->image('header_btn_supporter.png', array('alt'=>'マイサポーター')), array('controller' => 'feeds', 'action' => 'index'), array('escape' => false, 'title'=>'SNSタイムライン'));?></li>
						</ul>
					</nav>
				</header>
				
				<div id="topics">
					<div id="checkInSlider"></div>
					<div class="cloud"></div>
				</div>
				
				<div id="timeline" class="woodFrame">
					<div class="woodWrapper">
						<ul>
						<li>
							<a href="#">
							<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">
							<div class="activity">
								<p class="comment">
                                <span><?php echo $nickname; ?>さん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment">2</span><span class="otsu">50</span></p>
									<p class="times">5分前</p>
								</div>
							</div>
							</a>
						</li>
						<li>
							<a href="#">
							<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">
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
						<li>
							<a href="#">
							<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">
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
						<li>
							<a href="#">
							<img src="img/dummy/dummy_avatar.png" alt="#" class="avatarIcon">
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
					</div>
				</div><!-- /#friendTimeline -->
			</div>
		</div><!-- /#container -->
	
	</body>
</html>
