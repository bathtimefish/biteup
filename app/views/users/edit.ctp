<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>
<?php echo $this->Session->flash(); ?>
   <div id="account">
    <form action="#" method="post">
    <div class="woodFrame registFrame noTitle">
     <div class="woodWrapper">
     <?php echo $this->Form->create('User');?>
     <dl>
      <dt>あなたのニックネーム</dt>
        <dd><?php if(!empty($user['User']['username'])) echo $user['User']['username']; ?></dd>
      <dt>メールアドレス</dt>
        <dd><?php if(!empty($user['User']['email'])) echo $user['User']['email']; ?></dd>
      <dt>Facebook</dt>
        <?php if(!$fb_uid) { ?>
          <dd><?php echo $this->Html->link(__('Facebook Authorization', true), array('action' => 'fbauth'));?></dd>
        <?php } else { ?>
          <dd><?php echo $this->Html->link(__('My Facebook Account', true), 'http://m.facebook.com/home.php?__user='.$fb_uid); ?></dd>
        <?php } ?>
      <dt>パスワード</dt>
        <dd><?php //echo $this->Html->link(__('Change Password', true), array('action' => 'chpwd'));?></dd>
        <dd><?php echo $this->Form->input('new_password', array('type'=>'password', 'div'=>false, 'label'=>false, 'value'=>'')); ?></dd>
      <dt>パスワードの確認</dt>
        <dd><?php echo $this->Form->input('renew_password', array('type'=>'password', 'div'=>false, 'label'=>false, 'value'=>'')); ?></dd>
     </dl>
     <?php echo $this->Form->end(__('Edit', true));?>
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
