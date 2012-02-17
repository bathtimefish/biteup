<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>ログイン</title>
        <?php echo $this->Javascript->link('jquery-1.7.min');?>
        <?php echo $this->Javascript->link('global');?>
        <?php echo $this->Html->css('style', 'stylesheet', array('inline'=>true)); ?>
        <?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>true)); ?>
	</head>
	
	<body class="nickname">
	
		<div id="container">
				<header>
                    <h1><?php __('Biteup'); ?></h1>
                    <p class="pageBack tapping"><?php echo $this->Html->link($this->Html->image('header_btn_back.png', array('alt'=>'戻る', 'width'=>'43', 'height'=>'34')), 'javascript:history.go(-1);', array('escape' => false));?></p>
				</header>
			
			<div id="bookArea">
				<p id="yourname"></p>
			</div>

			<div id="login" class="newRegistration">
                <?php if ($session->check('Message.auth')) echo $session->flash('auth'); ?>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Form->create('User', array('class'=>'loginForm'));?>
				<div class="woodFrame registFrame">
                <h1><?php echo $this->Html->image('regist_title_login.png', array('alt'=>'ログインする', 'width'=>'298', 'height'=>'54')); ?></h1>
					<div class="woodWrapper">
					<p class="text">あなたの絵本に帰るには、ログインをするぽ。</p>
					<dl>
						<dt><label for="_mail">メールアドレス</label></dt>
						<dd>
                            <?php echo $this->Form->input('email', array('div'=>false, 'label'=>false, 'id'=>'_mail', 'placeholder'=>'メールアドレスを入力', 'class'=>'loginRegist')); ?>
							<br><small>※ 半角英数字で入力するぽ。</small>
						</dd>
						<dt><label for="_pass">パスワード</label></dt>
						<dd class="ok">
                            <?php echo $this->Form->input('password', array('div'=>false, 'label'=>false, 'id'=>'_pass', 'placeholder'=>'パスワードを入力', 'class'=>'loginRegist')); ?>
							<br><small>※ 半角英数字6文字以上で入力するぽ。</small>
						</dd>
					</dl>
					<p class="forgetPW"><a href="#">パスワードを忘れたら</a></p>
					</div>
				</div>
                <p class="alC"><?php echo $this->Form->submit('login_btn_login.png', array('alt'=>'絵本にはいる！', 'width'=>'312', 'div'=>False, 'label'=>False)); ?></p>
		        <p class="forgetPW"><?php echo $this->Html->link(__('Join to World', true), array('action' => 'join'));?></p>
				</form>
			</div>
			
		
		</div><!--/container-->
		<footer>
			<nav>
				<ul>
	    <li class="tapping"><?php echo $this->Html->link($this->Html->image('footer_btn_info.png', array('alt' => '登録情報', 'width' => '68', 'height' => '38')), array('controller'=>'users', 'action'=>'edit'), array('escape'=>false)); ?></a></li>
        <li class="tapping"><a href="#"><?php echo $html->image('footer_btn_guideline.png', array('alt' => '利用ガイドライン', 'width' => '107', 'height' => '38')); ?></a></li>
        <li class="tapping"><a href="#"><?php echo $html->image('footer_btn_about.png', array('alt' => 'designers hackとは', 'width' => '127', 'height' => '38')); ?></a></li>
				</ul>
			</nav>
			<p class="copyright">Copyright &copy; designers hack All Rights Reserved.</p>
		</footer>
	
	
	</body>
</html>
