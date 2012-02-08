<header>
    <h1><?php if(!empty($title)) { echo $title; }else { echo __('Biteup', true); } ?></h1>
    <p class="iprofileBtn tapping"><a href="javascript:history.go(-1);"><?php echo $this->Html->image('header_btn_back.png', array('alt'=>'戻る', 'width'=>43, 'height'=>34)); ?></a></p>
    <p class="profileBtn tapping"><?php echo $this->Html->link($this->Html->image('header_btn_logout.png', array('alt'=>'ログアウト', 'width'=>68, 'height'=>36)), array('controller' => 'users', 'action' => 'logout'), array('escape' => false));?></p>
    <nav>
        <ul>
            <li class="tapping"><?php echo $this->Html->link($this->Html->image('header_btn_timeline.png', array('alt'=>'タイムライン', 'width'=>117, 'height'=>49)), array('controller' => 'feeds', 'action' => 'index'), array('escape' => false, 'title'=>'タイムライン'));?></li>
            <li><?php echo $this->Html->link($this->Html->image('header_btn_regist.png', array('alt'=>'バイト予定登録', 'width'=>71, 'height'=>72)), array('controller' => 'jobs', 'action' => 'add'), array('escape' => false, 'title'=>'バイト登録'));?></li>
            <li><?php echo $this->Html->link($this->Html->image('header_btn_mypage.png', array('alt'=>'マイページ', 'width'=>117, 'height'=>52)), array('controller' => 'users', 'action' => 'edit'), array('escape' => false, 'title'=>'マイページ'));?></li>
        </ul>
    </nav>
</header>
