<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
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

<div class="searchBox">
    <?php echo $this->Form->create('Friend', array('action'=>'search')); ?>
    <?php echo $this->Form->input('Friend.username', array('label'=>False, 'div'=>False, 'class'=>'searchTxt', 'placeholder'=>'名前を入れてください')); ?>
    <?php echo $this->Form->submit('search_btn.png', array('value'=>'検索', 'class'=>'searchBtn', 'width'=>'58')); ?>
    </form>
</div>


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
