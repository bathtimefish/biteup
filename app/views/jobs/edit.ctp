<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('cal_ui', false);?>
<?php echo $this->Javascript->link('ui.timeSelector');?>
<?php echo $this->Javascript->link('resistration');?>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>

<div id="registration_edit">
<?php //echo $this->Form->create('Job', array('onSubmit'=>'Biteup.checkResist(); return false;'));?>
<?php echo $this->Form->create('Job', array('onSubmit'=>'Biteup.checkResist();'));?>
<?php echo $this->Form->input('id'); ?>
    <div class="woodFrame registFrame">
        <h1><?php echo $this->Html->image('regist_title_select.png', array('alt'=>'バイト先を選ぶ', 'width'=>298, 'height'=>54)); ?></h1>
        <div class="woodWrapper">
            <dl>
                <dt id="newEver">バイト先を編集する</dt>
                <dd><?php echo $this->Form->input('name', array('type'=>'text', 'div'=>false, 'label'=>false, 'placeholder'=>'新しいバイト先をいれてぽ', 'class'=>'newRegist')); ?></dd>
                <dt>バイト先のジャンルを選ぶ</dt>
                <dd>
                    <?php echo $this->Form->input('jobkind_id', array('label'=>False, 'div'=>False, 'class'=>'selectWorks')); ?>
                </dd>
            </dl>
        </div>
    </div>
    <div class="woodFrame registFrame">
        <h1><?php echo $this->Html->image('regist_title_date.png', array('alt'=>'日時を入れてぽ', 'width'=>298, 'height'=>54)); ?></h1>
        <?php //　Job.startdate.year 等で日付値が正常に反映されないのでHTMLを直接書く ?>
        <input type="hidden" id="JobStartdateYear" name="data[Job][startdate][year]" value="<?php echo date('Y', strtotime($this->data['Job']['startdate'])); ?>">
        <input type="hidden" id="JobStartdateMonth" name="data[Job][startdate][month]" value="<?php echo date('n', strtotime($this->data['Job']['startdate'])); ?>">
        <input type="hidden" id="JobStartdateDay" name="data[Job][startdate][day]" value="<?php echo date('j', strtotime($this->data['Job']['startdate'])); ?>">
        <input type="hidden" id="hdnStartHour" name="data[Job][starttime][hour]" value="<?php echo date('G', strtotime($this->data['Job']['starttime'])); ?>">
        <input type="hidden" id="hdnStartMinute" name="data[Job][starttime][min]" value="<?php echo date('i', strtotime($this->data['Job']['starttime'])); ?>">
        <input type="hidden" id="hdnEndHour" name="data[Job][jobtime][hour]" value="<?php echo date('G', strtotime($this->data['Job']['jobtime'])); ?>">
        <input type="hidden" id="hdnEndMinute" name="data[Job][jobtime][min]" value="<?php echo date('i', strtotime($this->data['Job']['jobtime'])); ?>">
        <div class="woodWrapper">
            <dl>
                <dt>カレンダーから日付を選ぶ</dt>
                <dd id="biteCalCall" class="calender">
                <?php if(!empty($this->data['Job']['startdate'])) {
                    echo date('Y年n月j日', strtotime($this->data['Job']['startdate']));
                } else {
                    echo 'タップしてぽ！';
                } ?>
                </dd>
                <dd id="biteCalendar"></dd>
                <dt>バイトの開始時刻と時間を選ぶ</dt>
                <dd>
                    <div id="startTime" data-hour="hdnStartHour" data-minute="hdnStartMinute" class="time start">
                    <em><?php echo date('H', strtotime($this->data['Job']['starttime'])); ?></em>
                    <em><?php echo date('i', strtotime($this->data['Job']['starttime'])); ?></em>
                    </div>から
                    <div id="timeFrame1"></div>
                    <div id="endTime" data-hour="hdnEndHour" data-minute="hdnEndMinute" class="time while">
                    <em><?php echo date('H', strtotime($this->data['Job']['jobtime'])); ?></em>時間
                    <em><?php echo date('i', strtotime($this->data['Job']['jobtime'])); ?></em>分</div>
                    <div id="timeFrame2"></div>
                </dd>
            </dl>
        </div>
    </div>

    <p class="alC"><?php echo $this->Form->submit('btn_bite_edit.png', array('alt'=>"変更する", 'width'=>"233", 'height'=>"57", 'div'=>false, 'label'=>false)); ?></p>
    <p class="alC delete"><?php echo $this->Html->link($this->Html->image('btn_bite_delete.png', array('alt'=>'この予定を削除する', 'width'=>'200', 'height'=>'38')), array('action'=>'delete', $this->Form->value('Job.id')), array('escape'=>false), __('Are you sure you want to delete ?', true)); ?></p>
</form>
</div><!-- /#registration -->	

