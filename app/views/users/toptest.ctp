<!-- ここから、サーバに吐き出してもらいたいscript -->
<script>
	var userData = { rows: [ {userName:"nakashizu",userID:123456}] };
</script>
<!-- / ここから、サーバに吐き出してもらいたいscript -->

<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('jquery.subwindow', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
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
<?php echo $this->Html->css('jquery.subwindow', 'stylesheet', array('inline'=>false)); ?>

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
