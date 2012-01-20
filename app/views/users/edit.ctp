<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>

			<div id="account">
				<form action="#" method="post">
				<div class="woodFrame registFrame noTitle">
					<div class="woodWrapper">
					<dl>
						<dt>あなたのニックネーム</dt>
                        <dd><?php if(!empty($user['User']['username'])) echo $user['User']['username']; ?></dd>
						<dt>メールアドレス</dt>
                        <dd><?php if(!empty($user['User']['email'])) echo $user['User']['email']; ?></dd>
						<dt>パスワード</dt>
		                <dd><?php echo $this->Html->link(__('Change Password', true), array('action' => 'chpwd'));?></dd>
                        <dt>Facebook</dt>
                        <?php if(!$fb_uid) { ?>
		                  <dd><?php echo $this->Html->link(__('Facebook Authorization', true), array('action' => 'fbauth'));?></dd>
                        <?php } else { ?>
                          <dd><?php echo $html->Html->link(__('My Facebook Account', true), 'http://m.facebook.com/home.php?__user='.$fb_uid); ?></dd>
                        <?php } ?>
					</dl>
					</div>
				</div>
				
				<div class="registBtn">
                    <p><?php echo $this->Html->link($this->Html->image('btn_logout.png', array('alt'=>'Logout', 'width'=>'113', 'height'=>'33')), array('action' => 'logout'), array('escape' => false));?></p>
                    <p><?php echo $this->Html->link($this->Html->image('btn_quit.png', array('alt'=>'Retire', 'width'=>'129', 'height'=>'33')), array('action' => 'retire'), array('escape' => false));?></p>
				</div>
				
				</form>
				
			</div><!-- /#account -->
	
		</div><!-- /#container -->
	
	</body>
</html>
