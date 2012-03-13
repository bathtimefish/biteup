<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('checkin_ui', false);?>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>

<script>
$(function (){
    var sl = new checkInUI();
    sl.isWorking = true; //勤務中はtrue,つまりチェックアウトが出る
    sl.init("checkInSlider");
});
</script>


<div class="woodFrame listWrap">
<div class="woodWrapper">
<?php if(!empty($jobs)) { ?>
<ul>
    <?php
    $wday = array(
        0 => '日',
        1 => '月',
        2 => '火',
        3 => '水',
        4 => '木',
        5 => '金',
        6 => '土',
    );
    ?>
    <?php
	foreach ($jobs as $job):
	?>
	<li>
        <a href="<?php echo $this->webroot; ?>jobs/edit/<?php echo $job['Job']['id']; ?>">
			<div class="kind">
                <h3>
                    <?php $this->Html->image('icon_job_sampling.jpg', array('alt'=>'', 'width'=>'25', 'height'=>'25')); ?>
                    <?php echo $job['Job']['name']; ?>
                    <span><? echo $job['Jobkind']['name']; ?></span>
                </h3>
                <?php $sd = getdate(strtotime($job['Job']['startdate'].' '.$job['Job']['starttime'])); ?>
				<p><time datetime="2012-01-02T10:30Z">
                    <span class="date"><em><?php echo $sd['mon']; ?></em>月<em><?php echo $sd['mday']; ?></em>日<em><?php echo $wday[$sd['wday']]; ?></em>曜日</span>
                    <span class="time"><em><?php echo $sd['hours']; ?></em>時<em><?php echo $sd['minutes']; ?></em>分〜<em><?php echo $job['Job']['jobtime']; ?></em>時間</span>
				</time></p>
			</div>
		</a>
    </li>
    <?php endforeach; ?>
</ul>
<? } else { ?>
<p id="nolist">予定はまだないぽ。</p>
<? } ?>
<!-- test -->
<div style="text-align:center;margin-top:10px;">
<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
 | <?php echo $this->Paginator->numbers();?>
 |
<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
<!-- test -->
</div>
</div><!-- /.listWrap -->

