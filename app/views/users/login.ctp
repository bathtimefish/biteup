<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
        <title>ログイン</title>

        <?php echo $this->Javascript->link('jquery-1.7.min');?>
        <?php echo $this->Javascript->link('global');?>
        <?php echo $this->Html->css('style', 'stylesheet', array('inline'=>true)); ?>
	</head>
	
	<body class="login">
	
		<div id="container">
			<h1><img src="#" alt="Logo"></h1>
            <?php if ($session->check('Message.auth')) echo $session->flash('auth'); ?>
			
			<h2>あなたのワールドに入りましょう</h2>
            <?php echo $this->Form->create('User', array('class'=>'loginForm'));?>
				<div class="loginInput">
					<div class="inputItem">
						<h3>メールアドレス</h3>
                        <p><?php echo $this->Form->input('email', array('div'=>false, 'label'=>false)); ?></p>
					</div>
					<div class="inputItem">
						<h3>パスワード</h3>
                        <p><?php echo $this->Form->input('password', array('div'=>false, 'label'=>false)); ?><a href="#">？</a></p>
					</div>
				</div>
				<p class="loginBtn"><a href="2_top.html">ワールドに入る</a></p>
            <?php echo $this->Form->end(__('Login to World', true));?>
			
			<p><a href="1_regist.html">ニックネームを登録する</a></p>

		</div><!--/container-->
	
	
	</body>
</html>
