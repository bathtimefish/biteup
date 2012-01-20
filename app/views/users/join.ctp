<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
		<title>新規登録</title>
        <?php echo $this->Javascript->link('jquery-1.7.min');?>
        <?php echo $this->Javascript->link('global');?>
        <?php echo $this->Html->css('style', 'stylesheet'); ?>
	</head>
	
	<body class="login">
	
		<div id="container">
			
			<h1><img src="#" alt="Logo"></h1>
            <?php echo $this->Session->flash(); ?>
			
			<h2>まずはあなたのワールドを登録しましょう</h2>
			
            <?php echo $this->Form->create('User', array('class'=>'registForm'));?>
				<div class="registInput">
					<div class="inputItem">
						<h3>メールアドレス</h3>
                        <p><?php echo $this->Form->input('email', array('div'=>false, 'label'=>false)); ?></p>
					</div>
					<div class="inputItem">
						<h3>ニックネーム</h3>
                        <p><?php echo $this->Form->input('username', array('div'=>false, 'label'=>false)); ?></p>
					</div>
					<div class="inputItem">
						<h3>パスワード</h3>
                        <p><?php echo $this->Form->input('join_password', array('type'=>'password', 'value'=>'', 'div'=>false, 'label'=>false)); ?></p>
					</div>
				</div>
				<p class="registBtn"><a href="1_2_regist_error.html">ワールドをはじめる</a></p>
            <?php echo $this->Form->end(__('Join to World', true));?>
		</div><!--/container-->
	
	
	</body>
</html>
