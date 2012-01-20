<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no"><!---->
        <?php echo $this->Html->meta('icon'); ?>
        <title>トップページ</title>
        <?php echo $this->Javascript->link('jquery-1.7.min');?>
        <?php if(!empty($async_json_data)) { ?>
          <script>
            var asyncResult = <?php echo $async_json_data; ?>
          </script>
        <?php } ?>
        <?php echo $scripts_for_layout; ?>
        <?php echo $this->Html->css('style', 'stylesheet', array('inline'=>true)); ?>
    </head>
        <body>
            <div id="container">
            <div class="containerInner">
            <header>
                    <span class="profileBtn">
                        <?php echo $this->Html->link($this->Html->image('header_btn_profile.png', array('alt'=>'MyProfile')), array('action' => 'edit'), array('escape' => false));?>
                    </span>
     <nav>
      <ul>
                            <li><?php echo $this->Html->link($this->Html->image('header_btn_list.png', array('alt'=>'予定リスト')), array('controller' => 'jobs', 'action' => 'index'), array('escape' => false));?></li>
                            <li><?php echo $this->Html->link($this->Html->image('header_btn_regist.png', array('alt'=>'バイト予定登録')), array('controller' => 'jobs', 'action' => 'add'), array('escape' => false));?></li>
                            <li><?php echo $this->Html->link($this->Html->image('header_btn_supporter.png', array('alt'=>'マイサポーター')), array('controller' => 'feeds', 'action' => 'index'), array('escape' => false, 'title'=>'SNSタイムライン'));?></li>
      </ul>
     </nav>
            </header>

   <?php echo $this->Session->flash(); ?>

   <?php echo $content_for_layout; ?>

  </div><!-- /#contenerInner -->
  </div><!-- /#container -->
 <?php echo $this->element('sql_dump'); ?>
</body>
</html>
