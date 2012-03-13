        <!-- ここから、サーバに吐き出してもらいたいscript -->
		<script>
			var userData = { rows: [ {userName:"nakashizu",userID:123456}] };
			Charactor.getCharaData();
		</script>
		<!-- / ここから、サーバに吐き出してもらいたいscript -->

<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
<?php echo $this->Javascript->link('charactor', false);?>
<?php echo $this->Javascript->link('sync', false);?>

		<script>
		
			$(function (){
					var sl = new checkInUI();
					
					//初回1度だけ、通信をかける
					Sync.once(2, function (res){
                        //バイト予定が入っていたら
						if(res.job.date) {
							var date = res.job.date.split("-");
							var times = res.job.startTime.split("-");
							var comments = date[1]+"月"+date[2]+"日 "+times[0]+"時"+times[1]+"分から"+res.job.name+"でバイトが入ってるぽ！";
							//バイト先とか、どうする？
							$(".cloud").text(comments);
						}
					});
					//
					
					//ポーリングスタート、間隔の時間設定はSync内で
					alert("hoge")
					Sync.start(2,function (res){
						if(res.job) {
							sl.init("checkInSlider", res.job.id, false);
						}
					});
					//
					
					//console.log("lastID",$("#timeline ul li:last-child").data("feed-id"))
					//もっと読むのタップ時に一度だけポーリング
					$("#moreFeed").bind("click", function (){
						$(this).find("span").show();
						var Itimers = setInterval(function () {
							clearInterval(Itimers);
							Sync.more(5, function (res){
								console.log("応答",res.feeds)
									if(res.feeds !== null) {
										var dom = "";
										for (var i = 0; i<res.feeds.length; i++) {
											//1フィードごとに時間を計算する
											var times = Global.compareTime(res.feeds[i].created);
											
											dom += '<li data-friend-jobkind="'+res.feeds[i].jobkind+'" data-friend-level="'+res.feeds[i].level+'" data-friend-level="'+res.feeds[i].id+'"><a href="/a/feeds/detail/'+res.feeds[i].id+'"><canvas width="80" height="80" class="avatarIcon"></canvas><div class="activity"><p class="comment">'+res.feeds[i].body+'</p><div class="footer"><p class="icon"><span class="comment">'+res.feeds[i].likesCount+'</span><span class="otsu">'+res.feeds[i].commentCount+'</span></p><p class="times">'+times+'</p></div></div></a></li>';
										}
									$(dom).appendTo(".woodWrapper ul").hide().slideDown(1000, function (){
										$("#moreFeed span").hide();
										});
									Global.thumbnail2Canvas();
								}else{
									//もし{feed: null}だったら
<<<<<<< HEAD
									$("#moreFeed").css({
										"background":"url(/a/img/btn_readnomore.png) no-repeat center top",
										"background-size":"299px 86px",
										"width":"299px",
										"height":"86px",
										"padding-bottom":"0"
										});
=======
									$("#moreFeed").unbind("click");
									$("#moreFeed").css("background-image","url(/a/app/webroot/img/btn_readnomore.png)");
>>>>>>> test
									$("#moreFeed span").hide();
								}
								
							},$("#timeline ul li:last-child").data("feed-id"));
							
						}, 500);
					});
					//
					
				});
				
		</script>

<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>
<?php echo $this->Html->css('jquery.subwindow', 'stylesheet', array('inline'=>false)); ?>

<div id="topics">
    <div id="checkInSlider" data-user-id="<?php if(!empty($userid)) echo $userid; ?>" data-job-id="<?php if(!empty($latestjob['Job']['id'])) echo $latestjob['Job']['id']; ?>"></div>
    <div class="cloud">
    <?php if(!empty($latestjob)) { ?>
        <?php $ljd = date_parse($latestjob['Job']['startdate'].' '.$latestjob['Job']['starttime']); ?>
        <?php echo $ljd['month']; ?>月<?php echo $ljd['day']; ?>日、<?php echo $ljd['hour']; ?>:<?php echo sprintf("%02d", $ljd['minute']); ?>からバイトが入っています！
    <?php } else { ?>
        バイトは入ってないぽ。
    <?php } ?>
    </div>
</div>
<!-- div class="searchBox">
    <?php echo $this->Form->create('Friend', array('action'=>'search')); ?>
    <?php echo $this->Form->input('Friend.username', array('label'=>False, 'div'=>False, 'class'=>'searchTxt', 'placeholder'=>'名前を入れてください')); ?>
    <?php echo $this->Form->submit('search_btn.png', array('value'=>'検索', 'class'=>'searchBtn', 'width'=>'58')); ?>
    </form>
</div -->

<div id="timeline" class="woodFrame">
    <div class="woodWrapper">
    <?php if(!empty($feeds)) { // Friend Timeline Loop ?>
    <ul>
      <?php foreach($feeds as $feed) { ?>
      <li data-friend-jobkind="<?php echo $feed['User']['current_jobkind_id']; ?>" data-friend-level="<?php echo $feed['User']['current_level']; ?>" data-feed-id="<?php echo $feed['Feed']['id']; ?>">
      <a href="<?php echo $this->webroot; ?>feeds/detail/<?php echo $feed['Feed']['id']; ?>">
           <canvas width="80" height="80" class="avatarIcon"></canvas>
           <div class="activity">
             <p class="comment">
               <span><?php echo $feed['User']['username']; ?>さん</span>
               <?php echo $feed['Feed']['message']; ?>
             </p>
             <div class="footer">
               <p class="icon">
                 <span class="comment"><?php echo $feed['Like']['comments']; ?></span><!--コメント数-->
                 <span class="otsu"><?php echo $feed['Like']['likes']; ?></span><!--オツカレ数-->
               </p>
               <p class="times"><?php echo $feed['Feed']['created']; ?></p>
             </div>
           </div>
         </a>
      </li>
      <? } ?>
    </ul>
    <?php } ?>
    <p id="moreFeed">もっと読む…<span>
    <?php echo $this->Html->image('icon_otsukare_load.png', array('alt'=>'loading')); ?>
    </span></p>
</div>
</div><!-- /#friendTimeline -->
