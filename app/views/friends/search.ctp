<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
<?php echo $this->Javascript->link('charactor', false);?>
<script>
    $(function (){
        var sl = new checkInUI();
        sl.isWorking = true; //勤務中はtrue,つまりチェックアウトが出る
        sl.init("checkInSlider");
    });
</script>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>
<div class="searchBox">
    <?php echo $this->Form->create('Friend'); ?>
    <?php echo $this->Form->input('Friend.username', array('label'=>False, 'div'=>False, 'class'=>'searchTxt', 'placeholder'=>'名前を入れてください')); ?>
    <?php echo $this->Form->submit('search_btn.png', array('value'=>'検索', 'class'=>'searchBtn', 'width'=>'58')); ?>
    </form>
</div>

<div class="woodFrame friendList">
    <div class="woodWrapper">
        <?php if(!empty($friends)) { ?>
        <ul>
        <?php foreach($friends as $friend) { ?>
            <li data-friend-jobkind="<?php echo $friend['User']['current_jobkind_id']; ?>" data-friend-level="<?php echo $friend['User']['current_jobkind_id']; ?>">
                <a href="<?php echo $this->webroot; ?>/friends/view/<?php echo $friend['User']['id']; ?>">
                <canvas width="80" height="80" class="avatarIcon"></canvas>
                <div class="activity">
                    <h2><?php echo $friend['User']['username'] ?>さん</h2>
                    <div class="friendStatus">
                        <p class="status"><?php echo $friend['User']['status']; ?></p>
                        <p class="job"><?php echo $friend['User']['jobkind']; ?></p>
                        <p class="level"><?php echo $friend['User']['current_level']; ?></p>
                    </div>
                </div>
                </a>
            </li>
        <?php } ?>
        </ul>
        <?php } else { ?>
            <p>一致するサポーターがみつかりません</p>
        <?php } ?>
        <p id="moreFeed">もっと読む…<span>
        <?php echo $this->Html->image('icon_otsukare_load.png', array('alt'=>'loading')); ?>
        </span></p>
    </div>
</div><!-- /#friendTimeline -->
