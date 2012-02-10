<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>絵本をつくる</title>
        <?php echo $this->Javascript->link('jquery-1.7.min');?>
        <?php echo $this->Javascript->link('global');?>
        <?php echo $this->Html->css('style', 'stylesheet', array('inline'=>true)); ?>
        <?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>true)); ?>
	</head>
	
	<body class="nickname">
	
		<div id="container">
				<header>
					<h1>バイトの妖精</h1>
                    <p class="pageBack tapping"><?php echo $this->Html->link($this->Html->image('header_btn_back.png', array('alt'=>'戻る', 'width'=>'43', 'height'=>'34')), 'javascript:history.go(-1);', array('escape' => false));?></p>
                    <p class="profileBtn tapping"><?php echo $this->Html->link($this->Html->image('header_btn_login.png', array('alt'=>'ログイン', 'width'=>'68', 'height'=>'36')), array('controller' => 'users', 'action' => 'login'), array('escape' => false));?></p>
				</header>
			
			<div id="bookArea">
				<p id="yourname"></p>
			</div>

			<div id="login" class="newRegistration">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Form->create('User', array('class'=>'loginForm'));?>
				<div class="woodFrame registFrame">
                <h1><?php echo $this->Html->image('regist_title_regist.png', array('alt'=>'あなたの絵本をつくる', 'width'=>'298', 'height'=>'54')); ?></h1>
					<div class="woodWrapper">
					<p class="text">あなたの絵本をつくるから、少しだけあなたのことを教えてぽ。</p>
					<dl>
						<dt><label for="_name">ニックネーム</label></dt>
						<dd>
                            <?php echo $this->Form->input('username', array('div'=>false, 'label'=>false, 'id'=>'_name', 'placeholder'=>'ニックネームを入力', 'class'=>'loginRegist')); ?>
							<br><small>※ 半角英数字で入力するぽ。</small>
						<dt><label for="_mail">メールアドレス</label></dt>
						<dd>
                            <?php echo $this->Form->input('email', array('div'=>false, 'label'=>false, 'id'=>'_mail', 'placeholder'=>'メールアドレスを入力', 'class'=>'loginRegist')); ?>
							<br><small>※ 半角英数字で入力するぽ。</small>
						</dd>
						<dt><label for="_pass">パスワード</label></dt>
                        <dd class="ok"><?php echo $this->Form->input('join_password', array('type'=>'password', 'value'=>'', 'id'=>'_pass', 'placeholder'=>'パスワードを入力', 'class'=>'loginRegist', 'div'=>false, 'label'=>false)); ?></dd>
                        <dd><?php echo $this->Form->input('re_password', array('type'=>'password', 'value'=>'', 'id'=>'_pass2', 'placeholder'=>'確認用パスワードの再入力', 'class'=>'loginRegist', 'div'=>false, 'label'=>false)); ?></dd>
						<br><small>※ 半角英数字6文字以上で入力するぽ。</small>
						</dd>
					</dl>
					</div>
				</div>
				<div class="btnArea">
                    <p><?php echo $this->Html->link($this->Html->image('regist_btn_back.png', array('alt'=>'戻る', 'width'=>'67')), 'javascript:history.go(-1);', array('escape' => false));?></p>
                    <p><?php echo $this->Form->submit('login_btn_regist.png', array('alt'=>"絵本をつくる！", 'value'=>"新規登録送信", 'width'=>"235")); ?></p>
				</div>
				<p class="loginAttention"><a href="#">利用ガイドライン</a>に同意の上、[絵本をつくる]ボタンをクリックすると登録が完了致します。個人情報保護方針についても利用ガイドラインからご確認ください。</p>
				</form>
			</div>
			
		
		</div><!--/container-->
		<footer>
			<nav>
				<ul>
					<li class="tapping"><a href="#"><img src="img/footer_btn_info.png" alt="登録情報" width="68" height="38"></a></li>
					<li class="tapping"><a href="#"><img src="img/footer_btn_guideline.png" alt="利用ガイドライン" width="107" height="38"></a></li>
					<li class="tapping"><a href="#"><img src="img/footer_btn_about.png" alt="designers hackとは" width="127" height="38"></a></li>
				</ul>
			</nav>
			<p class="copyright">Copyright &copy; designers hack All Rights Reserved.</p>
		</footer>
	
	
	</body>
</html>

