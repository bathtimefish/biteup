<!DOCTYPE HTML>
<html>
 <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
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
 <?php echo $this->element('sql_dump'); ?>
</body>
</html>
