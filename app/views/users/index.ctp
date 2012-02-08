<?php $title = 'トップページ'; ?>

        <!-- ここから、サーバに吐き出してもらいたいscript -->
		<script>
			var userData = { rows: [ {userName:"nakashizu",userID:123456}] };
		</script>
		<!-- / ここから、サーバに吐き出してもらいたいscript -->

<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
<?php echo $this->Javascript->link('charactor', false);?>
<?php echo $this->Javascript->link('sync', false);?>

		<script>
		
			$(function (){
					var sl = new checkInUI();
					
					//sl.isWorking = false; //勤務中はtrue,つまりチェックアウトが出る
					/*var gTimer = setInterval(function (){
							sl.init("checkInSlider", false);
						}, 10000);*/
					
					
					//$.fn.subwindow.open("alert/sending.html", {"filter":"#target"}, 200,200);
					/*$(".profileBtn").click(function (e){
						e.preventDefault();
							
						})*/
						
					Sync.start(2,function (obj){
							if(obj.isCheckin) {
								sl.init("checkInSlider", false);
							}
						});
						
					$("#moreFeed").bind("click", function (){
						Sync.once(2, function (res){
								if(res.feeds) {
									//console.log(res.feeds);
									var dom = "";
									for (var i = 0; i<res.feeds.length; i++) {
										
										//本来ここで1フィードごとに時間を計算する
											
										dom += '<li data-friend-jobkind="'+res.feeds[i].jobKind+'" data-friend-level="'+res.feeds[i].level+'"><a href="#"><canvas width="80" height="80" class="avatarIcon"></canvas><div class="activity"><p class="comment">'+res.feeds[i].body+'</p><div class="footer"><p class="icon"><span class="comment">'+res.feeds[i].likesCount+'</span><span class="otsu">'+res.feeds[i].commentCount+'</span></p><p class="times">'+res.feeds[i].created+'</p></div></div></a></li>';
									}
									console.log(dom)
									$(dom).appendTo(".woodWrapper ul").hide().slideDown(1000);
									Thumbnail2Canvas();
								}
							});
						
						});
					
				});
				
		</script>
		
<?php echo $this->Html->css('jquery.subwindow', 'stylesheet', array('inline'=>false)); ?>
	
				
<div id="topics">
    <div id="checkInSlider"></div>
    <div class="cloud">○月○日、18:00からバイトが入っています！</div>
</div>

<div id="timeline" class="woodFrame">
    <div class="woodWrapper">
    <?php if(!empty($feeds)) { // Friend Timeline Loop ?>
     <ul>
      <?php foreach($feeds as $feed) { ?>
      <li data-friend-jobkind="<?php echo $feed['User']['current_jobkind_id']; ?>" data-friend-level="<?php echo $feed['User']['current_jobkind_id']; ?>">
      <a href="/a/feeds/detail/<?php echo $feed['Feed']['id']; ?>">
           <canvas width="80" height="80" class="avatarIcon"></canvas>
           <div class="activity">
             <p class="comment">
               <span><?php echo $feed['User']['username']; ?>さん</span>
               <?php echo $feed['Feed']['message']; ?>
             </p><!-- **** 実装が途中まで。これもJSで出力したほうがいいかも？ *** -->
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
    <p id="moreFeed">もっと読む…</p>
    </div>
</div><!-- /#friendTimeline -->
