<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('charactor', false);?>
<?php echo $this->Javascript->link('sync', false);?>

		<script>
		$(function (){
				
				//もっと読むのタップ時に一度だけポーリング
					$("#moreFeed").bind("click", function (){
						$(this).find("span").show();
						var Itimers = setInterval(function () {
							clearInterval(Itimers);
							Sync.more(5, function (res){
								//console.log("応答",res.feeds)
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
									$("#moreFeed").css({
										"background":"url(/a/img/btn_readnomore.png) no-repeat center top",
										"background-size":"299px 86px",
										"width":"299px",
										"height":"86px",
										"padding-bottom":"0"
										});
									$("#moreFeed span").hide();
								}
								
							},$("#timeline ul li:last-child").data("feed-id"));
							
						}, 500);
					});
				
			});
		</script>

<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>

<div class="mypageBtn">
    <p><?php echo $this->Html->link($this->Html->image('header_btn_list.png', array('alt'=>'予定リスト', 'width'=>'117')), array('controller'=>'jobs', 'action'=>'index'), array('escape'=>false)); ?></p>
</div>
<div class="profile">
    <h1><?php echo $user['User']['username']; ?></h1>
    <p class="profileAvatar" data-friend-jobkind="<?php echo $user['User']['current_jobkind_id']; ?>" data-friend-level="<?php echo $user['User']['current_level']; ?>">
    <script>
		//console.log($(".profileAvatar").data("friend-jobkind"), $(".profileAvatar").data("friend-level"));
				//var avatarData = {kind:}
        var s = Charactor.getImage($(".profileAvatar").data("friend-jobkind"), $(".profileAvatar").data("friend-level"));
        document.write(s);
    </script>
    </p>
    <div class="profileBg">
        <div class="profileDetail">
            <div class="profileLevel">
                <h2><?php echo $level['Level']['name']; ?><span><?php echo $jobkind['Jobkind']['name'] ?></span></h2>
                <p class="level"><?php echo $user['User']['current_level'] ?></p>
            </div>
            <ul class="profileCount">
                <li class="otsukare"><?php echo $likecnt; ?></li>
                <li class="checkout"><?php echo $checkoutcnt; ?></li>
            </ul>
        </div><!-- /.profileDetail -->
        <!-- 未実装
        <div class="pointGage">
            <p class="meter"><span></span></p>
            <div class="gage">
                <p class="text">LEVEL2まであと<strong>35 pt</strong></p>
                <p class="point">20 pt</p>
            </div>
        </div>
        -->
    </div><!-- /.profileBg -->
</div><!-- /.profile -->
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
    <?php if(!empty($feeds)) { ?>
    <p id="moreFeed">もっと読む…<span><img src="/a/img/icon_otsukare_load.png" alt="loading"></span></p>
    <? } else { ?>
    <p id="nolist">
    <?php echo $this->Html->link('予定を登録してバイトをするぽ！', array('controller'=>'jobs', 'action'=>'add')); ?>
    </p>
    <? } ?>
    </div>
</div><!-- /#friendTimeline -->
