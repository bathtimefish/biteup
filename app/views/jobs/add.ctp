<?php echo $this->Javascript->link('global', false);?>
<?php echo $this->Javascript->link('cal_ui', false);?>
<?php echo $this->Javascript->link('resistration');?>
<?php echo $this->Html->css('tmp', 'stylesheet', array('inline'=>false)); ?>


			<div id="registration">
                <?php echo $this->Form->create('Job', array('onSubmit'=>'Biteup.checkResist(); return false;'));?>
				<div class="woodFrame registFrame">
                <h1><?php echo $this->Html->image('regist_title_select.png', array('alt'=>'バイト先を選ぶ', 'width'=>298, 'height'=>54)); ?></h1>
					<div class="woodWrapper">
					<dl>
						<dt id="haveEver">今までのバイト先から選ぶ</dt>
						<dd>
                        <?php echo $this->Form->input('job_selected', array('type'=>'select', 'options'=>$jobs, 'class'=>'selectWorks', 'label'=>false, 'div'=>false, 'id'=>'company')); ?>
						</dd>
						<dt id="newEver">新しいバイト先を追加する</dt>
                        <dd style="display: none;"><?php echo $this->Form->input('name', array('type'=>'text', 'div'=>false, 'label'=>false, 'placeholder'=>'新しいバイト先をいれてぽ', 'class'=>'newRegist')); ?></dd>
						<dt>バイト先のジャンルを選ぶ</dt>
						<dd>
							<select name="job" class="selectWorks">
								<option value="">▼ジャンルをえらんでぽ</option>
								<option value="力仕事・労働">力仕事・労働</option>
								<option value="オフィスワーク">オフィスワーク</option>
							</select>
						</dd>
					</dl>
					</div>
				</div>

				<div class="woodFrame registFrame">
                <h1><?php echo $this->Html->image('regist_title_date.png', array('alt'=>'日時を入れてぽ', 'width'=>298, 'height'=>54)); ?></h1>
					<div class="woodWrapper">
					<dl>
						<dt>カレンダーから日付を選ぶ</dt>
						<dd id="biteCalCall" class="calender">タップしてぽ！</dd>
						<dd id="biteCalendar"></dd>
						<dt>バイトの開始時刻と時間を選ぶ</dt>
						<dd>
							<div class="time start"><em></em><em></em></div>から
							<div class="time while"><em></em>時間<em></em>分</div>
						</dd>
					</dl>
					</div>
				</div>
				
				<p class="alC"><input type="image" src="/biteup/img/regist_btn.png" alt="予定を登録する" width="233" height="57"></p>
					<input type="hidden" name="jobPlace"><!-- 勤務先はここに設定 -->
                    <input type="hidden" name="date"><!-- 日付はここに設定 -->
                </form>
        <?php //echo $this->Form->end(__('Add', true)); ?>
			</div><!-- /#registration -->
