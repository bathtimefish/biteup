<?php
$comment_cnt = 0;
foreach ($likes as $like) {
	if ($like['Like']['message']!='')
		$comment_cnt++;
	} 
?>
<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('sync', false);?>
<?php echo $this->Javascript->link('charactor', false);?>

<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>

<div class="woodFrame friendTimelineDetail">
    <div class="woodWrapper">
        <ul>
            <li data-friend-jobkind="<?php echo $detail['User']['current_jobkind_id']; ?>" data-friend-level="<?php echo $detail['User']['current_level']; ?>" data-feed-id="<?php echo $detail['User']['id']; ?>">
                <canvas width="80" height="80" class="avatarIcon"></canvas>
                <div class="activity">
                    <p class="comment">
                        <span><?php echo $detail['User']['username'] ?>さん</span><?php echo $detail['Feed']['message']; ?>
                    </p>
                    <div class="footer">
                        <p class="icon"><span class="comment"><?php echo $comment_cnt; ?></span><span class="otsu"><?php echo count($likes) ?></span></p>
                        <p class="times"><?php echo $detail['Feed']['action_time'] ?></p>
                    </div>
                </div>
                <?php if($like_flg) : ?>
                <div class="commentForm">
                <?php echo $this->Form->create('Feed',array('controller' => 'feed', 'action' => 'detail','url'=>array($detail['Feed']['id']))); ?>
                    <p><?php echo $this->Form->input('message', array('type' => 'text', 'class' => 'newRegist', 'placeholder' => 'コメントをいれてあげるぽよ', 'label' => false, 'div' => false)); ?></p>
                    <p class="otsukareBtn"><?php echo $form->submit('comment_btn_otsukare.png', array('alt' => 'オツカレ', 'value' => 'オツカレ', 'width' => '70', 'div' => false)); ?></p>
                    <?php echo $this->Html->image('icon_otsukare_load.png', array('id'=>'otukareLoadIcon', 'style'=>'display:none;')); ?>
                </form>
                </div>
                <?php endif; ?>

                <div class="commentList">
                    <p class="otsukareBtnSumi"><?php echo $this->Html->image('comment_btn_otsukare_sumi.png', array('alt'=>'オツカレ済！', 'width'=>'280')); ?></p>
                    <ul>
                    <?php
                        foreach ($likes as $like) :
                            if ($like['Like']['message']!='') :
                    ?>
                    <li data-friend-jobkind="<?php echo $like['User']['current_jobkind_id']; ?>" data-friend-level="<?php echo $like['User']['current_level']; ?>">
                        <a href="<?php echo $this->webroot; ?>friends/view/<?php echo $like['Like']['friend_id']; ?>" >
                        <p class="commentAvatar"><canvas width="80" height="80"></canvas></p>
                        <div class="detail">
                            <h2><?php echo $like['User']['username']; ?></h2>
                            <p class="text"><?php echo $like['Like']['message']; ?></p>
                            <p class="times"><?php echo $like['Like']['action_time']; ?></p>
                        </div>
                        </a>
                    </li>
                <?php
                    endif;
                    endforeach;
                ?>
                    </ul>
                </div>

            </li>
        </ul>
        <?php if ( $comment_cnt > 5 ) : ?>
            <p id="moreFeed">もっと読む…<span><?php echo $this->Html->image('icon_otsukare_load.png', array('alt'=>'loading')); ?></span></p>
        <?php endif; ?>
    </div>
</div><!-- /#friendTimeline -->
