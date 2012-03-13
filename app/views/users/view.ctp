<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('charactor', false);?>
<?php echo $this->Javascript->link('sync', false);?>

		<script>
		$(function (){
				
				/*Sync.once( 9, function (res){
						var total = res.totalPoint;
						var level = res.level;
						var jobKind = res.jobkind;
						//もしかしたら要らないかも、、、
						//console.log(total);
					});*/
				
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
    <p id="moreFeed">もっと読む…<span><?php $this->Html->image('icon_otsukare_load.png', array('alt'=>'loading')); ?></span></p>
    </div>
</div><!-- /#friendTimeline -->
