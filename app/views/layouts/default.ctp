<!DOCTYPE HTML>
<html>
 <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php echo $this->Html->meta('icon'); ?>
        <title>Biteup</title>
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
   <?php echo $this->element('gnav'); // Global Navigation ?>
   <?php echo $this->Session->flash(); ?>

   <?php echo $content_for_layout; ?>

  </div><!-- /#contenerInner -->
  </div><!-- /#container -->
  <footer>
    <nav>
      <ul>
	    <li class="tapping"><a href="#"><?php echo $html->image('footer_btn_info.png', array('alt' => '登録情報', 'width' => '68', 'height' => '38')); ?></a></li>
        <li class="tapping"><a href="#"><?php echo $html->image('footer_btn_guideline.png', array('alt' => '利用ガイドライン', 'width' => '107', 'height' => '38')); ?></a></li>
        <li class="tapping"><a href="#"><?php echo $html->image('footer_btn_about.png', array('alt' => 'designers hackとは', 'width' => '127', 'height' => '38')); ?></a></li>
      </ul>
    </nav>
    <p class="copyright">Copyright &copy; designers hack All Rights Reserved.</p>
  </footer>
  <?php echo $this->element('sql_dump'); ?>
</body>
</html>
