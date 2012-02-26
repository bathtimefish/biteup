<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
<?php echo $this->Javascript->link('charactor', false);?>
<?php echo $this->Javascript->link('sync', false);?>
		<script>
		
			$(function (){
					
					var pasts = 123; // これ、最後のjobIDをどう取得してくる！？
				
					//もっと読むのタップ時に一度だけポーリング
					$("#moreFeed").bind("click", function (){
						$(this).find("span").show();
						var Itimers = setInterval(function () {
							clearInterval(Itimers);
							Sync.once(7, function (res){
									if(res.feeds) {
										var dom = "";
										for (var i = 0; i<res.feeds.length; i++) {
											var times = Global.compareTime(res.feeds[i].created);
											dom += '<li data-friend-jobkind="'+res.feeds[i].jobKind+'" data-friend-level="'+res.feeds[i].level+'"><a href="#"><canvas width="80" height="80" class="avatarIcon"></canvas><div class="activity"><p class="comment">'+res.feeds[i].body+'</p><div class="footer"><p class="icon"><span class="comment">'+res.feeds[i].likesCount+'</span><span class="otsu">'+res.feeds[i].commentCount+'</span></p><p class="times">'+times+'</p></div></div></a></li>';
										}
									$(dom).appendTo(".woodWrapper ul").hide().slideDown(1000, function (){
										$("#moreFeed span").hide();
										});
									Global.thumbnail2Canvas();
								}
							}, pasts);
						}, 1000);
					});
					//
				
				});
				
		</script>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>

<div class="searchBox">
    <?php echo $this->Form->create('Friend', array('action'=>'search')); ?>
    <?php echo $this->Form->input('Friend.username', array('label'=>False, 'div'=>False, 'class'=>'searchTxt', 'placeholder'=>'名前を入れてください')); ?>
    <?php echo $this->Form->submit('search_btn.png', array('value'=>'検索', 'class'=>'searchBtn', 'width'=>'58')); ?>
    </form>
</div>


<div class="woodFrame">
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
        <?php } else { ?>
        <div style="text-align:center">
        <p>友達を探してサポートしよう！</p>
        </div>
        <?php } ?>
        <p id="moreFeed">もっと読む…<span><img src="img/icon_otsukare_load.png" alt="loading"></span></p>
    </div>
</div><!-- /#friendTimeline -->
