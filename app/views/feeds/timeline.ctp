<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
<script>
		
			$(function (){
					var sl = new checkInUI();
					sl.isWorking = true; //勤務中はtrue,つまりチェックアウトが出る
					sl.init("checkInSlider");
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
						<ul>
<?php foreach ($timeline as $feed_id => $feed): ?>
						<li>
                            <a href="<?php echo $this->webroot; ?>feeds/detail/<?php echo $feed_id ?>">
							<?php echo $this->Html->image('dummy/dummy_avatar.png', array('alt'=>'#','class'=>'avatarIcon')); ?>
							<div class="activity">
								<p class="comment">
									<span><?php echo $feed['name']; ?>さん</span>がバイトにチェックインしました。
								</p>
								<div class="footer">
									<p class="icon"><span class="comment"><?php echo $feed['comment_count']; ?></span><span class="otsu"><?php echo $feed['like_count']; ?></span></p>
									<p class="times"><?php echo $feed['time']; ?></p>
								</div>
							</div>
							</a>
						</li>
<?php endforeach; ?>							
					</ul>
					</div>
				</div><!-- /#friendTimeline -->
