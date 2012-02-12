<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('cal_ui', false);?>
<?php echo $this->Javascript->link('ui.timeSelector');?>
<?php echo $this->Javascript->link('resistration');?>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>



<div id="registration">
    <?php //echo $this->Form->create('Job', array('onSubmit'=>'Biteup.checkResist(); return false;'));?>
    <?php echo $this->Form->create('Job', array('onSubmit'=>'Biteup.checkResist();'));?>
    <div class="woodFrame registFrame">
        <h1><?php echo $this->Html->image('regist_title_select.png', array('alt'=>'バイト先を選ぶ', 'width'=>298, 'height'=>54)); ?></h1>
        <div class="woodWrapper">
            <dl>
                <dt id="haveEver">今までのバイト先から選ぶ</dt>
                <dd>
                    <?php echo $this->Form->input('job_selected', array('type'=>'select', 'options'=>array_unique($jobs), 'class'=>'selectWorks', 'label'=>false, 'div'=>false, 'id'=>'company')); ?>
                </dd>
                <dt id="newEver">新しいバイト先を追加する</dt>
                <dd style="display: none;"><?php echo $this->Form->input('name', array('type'=>'text', 'div'=>false, 'label'=>false, 'placeholder'=>'新しいバイト先をいれてぽ', 'class'=>'newRegist')); ?></dd>
                <dt>バイト先のジャンルを選ぶ</dt>
                <dd>
                    <?php echo $this->Form->input('jobkind_id', array('label'=>False, 'div'=>False, 'class'=>'selectWorks')); ?>
                </dd>
            </dl>
        </div>
    </div>

    <div class="woodFrame registFrame">
        <h1><?php echo $this->Html->image('regist_title_date.png', array('alt'=>'日時を入れてぽ', 'width'=>298, 'height'=>54)); ?></h1>
        <?php echo $this->Form->input('Job.startdate.year', array('type'=>'hidden')); ?>
        <?php echo $this->Form->input('Job.startdate.month', array('type'=>'hidden')); ?>
        <?php echo $this->Form->input('Job.startdate.day', array('type'=>'hidden')); ?>
        <?php echo $this->Form->input('Job.starttime.hour', array('type'=>'hidden', 'id'=>'hdnStartHour')); ?>
        <?php echo $this->Form->input('Job.starttime.min', array('type'=>'hidden', 'id'=>'hdnStartMinute')); ?>
        <?php echo $this->Form->input('Job.jobtime.hour', array('type'=>'hidden', 'id'=>'hdnEndHour')); ?>
        <?php echo $this->Form->input('Job.jobtime.min', array('type'=>'hidden', 'id'=>'hdnEndMinute')); ?>
        <?php //echo $this->Form->input('startdate', array('type'=>'date', 'dateFormat'=>'YMD', 'monthNames'=>False, 'label'=>False)); ?>
        <?php //echo $this->Form->input('starttime', array('type'=>'time', 'timeFormat'=>'24', 'label'=>False)); ?>
        <?php //echo $this->Form->input('jobtime', array('type'=>'time', 'timeFormat'=>'24', 'label'=>False)); ?>
        <div class="woodWrapper">
            <dl>
                <dt>カレンダーから日付を選ぶ</dt>
                <dd id="biteCalCall" class="calender">タップしてぽ！</dd>
                <dd id="biteCalendar"></dd>
                <dt>バイトの開始時刻と時間を選ぶ</dt>
                <dd>
                    <div id="startTime" data-hour="hdnStartHour" data-minute="hdnStartMinute" class="time start"><em></em><em></em></div>から
                    <div id="timeFrame1"></div>
                    <div id="endTime" data-hour="hdnEndHour" data-minute="hdnEndMinute" class="time while"><em></em>時間<em></em>分</div>
                    <div id="timeFrame2"></div>
                </dd>
            </dl>
        </div>
    </div>
    <p class="alC"><?php echo $this->Form->submit('regist_btn.png', array('alt'=>"予定を登録する", 'width'=>"233", 'height'=>"57", 'div'=>false, 'label'=>false)); ?></p>
    <!-- 勤務時間は#biteCalendar em:first-childに文字列が入っているかで判断 --><!-- 職種はname = jobに設定 -->
</form>
</div><!-- /#registration -->

