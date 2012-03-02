<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>
<?php echo $this->Session->flash(); ?>
   <div id="account">
    <div class="woodFrame registFrame noTitle">
     <div class="woodWrapper">
     <?php echo $this->Form->create('User');?>
     <?php echo $this->Form->input('id', array('type'=>'hidden', 'value'=>$user['User']['id'])); ?>
     <dl>
      <dt>あなたのニックネーム</dt>
        <dd class="noedit"><?php if(!empty($user['User']['username'])) echo $user['User']['username']; ?></dd>
      <dt>メールアドレス</dt>
        <dd class="noedit"><?php if(!empty($user['User']['email'])) echo $user['User']['email']; ?></dd>
      <dt>Facebook</dt>
        <?php if(!$fb_uid) { ?>
          <dd><?php echo $this->Html->link(__('Facebook Authorization', true), array('action' => 'fbauth'));?></dd>
        <?php } else { ?>
          <dd><?php echo $this->Html->link(__('My Facebook Account', true), 'http://m.facebook.com/home.php?__user='.$fb_uid); ?></dd>
        <?php } ?>
      <dt>新しいパスワードに変更する</dt>
        <dd><?php //echo $this->Html->link(__('Change Password', true), array('action' => 'chpwd'));?></dd>
        <dd><?php echo $this->Form->input('new_password', array('type'=>'password', 'div'=>false, 'label'=>false, 'value'=>'', 'class'=>'newRegist', 'placeholder'=>'新しいパスワードを入力するぽ')); ?></dd>
        <dd><?php echo $this->Form->input('renew_password', array('type'=>'password', 'div'=>false, 'label'=>false, 'value'=>'', 'class'=>'newRegist', 'placeholder'=>'もう一度確認用に入力するぽ')); ?></dd>
     </dl>
     <p class="alC"><?php echo $this->Form->submit('btn_edit.png', array('alt'=>"編集する", 'width'=>"206", 'height'=>"60", 'div'=>false, 'label'=>false)); ?></p>
    </form>
     </div>
    </div>

    <div class="registBtn">
                    <p><?php echo $this->Html->link($this->Html->image('btn_quit.png', array('alt'=>'Retire', 'width'=>'310')), array('action' => 'retire'), array('escape' => false));?></p>
    </div>

   </div><!-- /#account -->
