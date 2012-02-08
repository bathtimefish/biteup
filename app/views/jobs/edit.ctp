<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('cal_ui', false);?>
<script>
window.onload = function (){
    var ev = "touchstart"; //touchstart
    $("#biteCalCall").bind(ev, showCalendar);
    function showCalendar(){
        $("#biteCalCall").unbind(ev);
        var cal = new dhCalUI("biteCalCall","biteCalendar");
        $(cal).bind("complete", function (e){
            $("#biteCalCall").bind(ev, showCalendar);
        });
    };
}
</script>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>
<div id="registration_edit">
     <?php echo $this->Form->create('Job');?>
    	<div class="woodFrame registFrame">
            <h1><?php echo $this->Html->image('regist_title_select.png', array('alt'=>'バイト先を選ぶ', 'width'=>298, 'height'=>54)); ?></h1>
			<div class="woodWrapper">
				<dl>
					<dt>今までのバイト先から選ぶ</dt>
                    <dd>
                        <?php echo $this->Form->input('job_selected', array('type'=>'select', 'options'=>$jobs, 'class'=>'selectWorks', 'label'=>false, 'div'=>false, 'empty'=>'▼えらんでぽ')); ?>
					</dd>
					<dt>新しいバイト先を追加する</dt>
                    <dd><?php echo $this->Form->input('name', array('type'=>'text', 'div'=>false, 'label'=>false, 'placeholder'=>'新しいバイト先をいれてぽ', 'class'=>'newRegist')); ?></dd>
					<dt>バイト先のジャンルを選ぶ</dt>
                    <dd>
                        <?php echo $this->Form->input('jobkind_id', array('class'=>"selectWorks", 'empty'=>'▼ジャンルを選んでぽ', 'div'=>false, 'label'=>false)); ?>
					</dd>
				</dl>
			</div>
		</div>
		<div class="woodFrame registFrame">
            <h1><?php echo $this->Html->image('regist_title_date.png', array('alt'=>'日時を入れてぽ', 'width'=>298, 'height'=>54)); ?></h1>
			<div class="woodWrapper">
				<dl>
					<dt>カレンダーから日付を選ぶ</dt>
					<dd id="biteCalCall" class="calender">2月10日</dd>
					<dd id="biteCalendar"></dd>
					<dt>バイトの開始時刻と時間を選ぶ</dt>
					<dd>
						<div class="time start"><em>10</em><em>00</em></div>から
						<div class="time while"><em>5</em>時間<em>00</em>分</div>
					</dd>
				</dl>
			</div>
		</div>
        <?php echo $this->Form->end(__('Edit', true));?>
		<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Job.id')), null, __('Are you sure you want to delete ?', $this->Form->value('Job.id'))); ?>
</div><!-- /#registration -->

