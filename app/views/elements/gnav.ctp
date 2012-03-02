<header>
    <h1><?php if(empty($title_for_action)) { echo __('Biteup', true); } else { echo $title_for_action; } ?></h1>
    <?php if($this->name == 'Users' && $this->action == 'index') { ?>
    <?php } else { ?>
      <p class="pageBack tapping"><?php echo $this->Html->link($this->Html->image('header_btn_back.png', array('alt'=>'戻る', 'width'=>'43', 'height'=>'34')), array('controller'=>'users', 'action'=>'index'), array('escape'=>false)); ?></p>
    <?php } ?>
    <p class="profileBtn tapping"><?php echo $this->Html->link($this->Html->image('header_btn_logout.png', array('alt'=>'ログアウト', 'width'=>'68', 'height'=>'36')), array('controller' => 'users', 'action' => 'logout'), array('escape' => false));?></p>
    <nav>
        <ul>
            <li class="tapping"><?php echo $this->Html->link($this->Html->image('header_btn_timeline.png', array('alt'=>'タイムライン', 'width'=>'117', 'height'=>'49')), array('controller' => 'feeds', 'action' => 'timeline'), array('escape' => false, 'title'=>'タイムライン'));?></li>
            <li><?php echo $this->Html->link($this->Html->image('header_btn_regist.png', array('alt'=>'バイト予定登録', 'width'=>'71', 'height'=>'72')), array('controller' => 'jobs', 'action' => 'add'), array('escape' => false, 'title'=>'バイト登録'));?></li>
            <li><?php echo $this->Html->link($this->Html->image('header_btn_mypage.png', array('alt'=>'マイページ', 'width'=>'117', 'height'=>'52')), array('controller' => 'users', 'action' => 'view'), array('escape' => false, 'title'=>'マイページ'));?></li>
        </ul>
    </nav>
</header>
