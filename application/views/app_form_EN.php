<?=$this->session->flashdata('alert')?>
<?=validation_errors()?>
<?=form_open($action)?>
<section class="content-header breadcrumb">
	<input type="hidden" name="country" value="EN">
	Form Code : <?=form_input(array('name'=>'code','type'=>'number','maxlength'=>'10','autocomplete'=>'off','value'=>set_value('code',(isset($row->code)?$row->code:""))))?>
	<ol class="breadcrumb">
	  <li class="active"><?=$heading?></li>
	  <li>User Entry : <b><?=$this->lib_general->get_username(isset($row->user_create)?$row->user_create:$this->session->userdata('user_login'))?></b></li>
	</ol>
</section>
<div class="row">
	<div class="col-md-5">
		<div class="panel panel-primary">
			<div class="panel-heading">
				QUESTIONS
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<?php for($i=1;$i<=3;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
					<div class="col-md-2">
						<?php for($i=4;$i<=14;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
					<div class="col-md-2">
						<?php for($i=15;$i<=25;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
					<div class="col-md-2">
						<?php for($i=26;$i<=36;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
					<div class="col-md-2">
						<?php for($i=37;$i<=47;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
					<div class="col-md-2">
						<?php for($i=48;$i<=55;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
				</div>	
			</div>
		</div>		
	</div>	
	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				COMMENTS
			</div>
			<div class="panel-body">
				<div class="form-group">
					<?=form_label('1. One thing you would change to make this organisation a better place to work')?>
					<?=form_textarea(array('name'=>'com_1','rows'=>'7','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('com_1',(isset($row->com_1)?$row->com_1:""))))?>
				</div><hr>
				<div class="form-group">
					<?=form_label('2. What do you like best about working at this organisation')?>
					<?=form_textarea(array('name'=>'com_2','rows'=>'7','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('com_2',(isset($row->com_2)?$row->com_2:""))))?>
				</div>
			</div>
		</div>
	</div>	
	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				DEMOGRAPHIC QUESTIONS
			</div>
			<div class="panel-body">
				<?=form_label('1. Please select the Department you work in (select only one)')?>
				<p>Jawab : <?=form_dropdown('dem_1',$this->mdl_divisi->dropdown('EN'),set_value('dem_1',(isset($row->dem_1)?$row->dem_1:"")))?></p><hr>
				<?=form_label('2. Please select the location you work in (select only one)')?>
				<p>Jawab : <?=form_dropdown('dem_2',dropnum(23),set_value('dem_2',(isset($row->dem_2)?$row->dem_2:"")))?></p><hr>
				<?=form_label('3. Which of the following best describes your role in this organisation')?>
				<p>Jawab : <?=form_dropdown('dem_3',dropnum(4),set_value('dem_3',(isset($row->dem_3)?$row->dem_3:"")))?></p><hr>
				<?=form_label('4. Which of the following best describes your years of service?')?>
				<p>Jawab : <?=form_dropdown('dem_4',dropnum(9),set_value('dem_4',(isset($row->dem_4)?$row->dem_4:"")))?></p><hr>
				<?=form_label('5. Which of the following best describes your gender?')?>
				<p>Jawab : <?=form_dropdown('dem_5',dropnum(2),set_value('dem_5',(isset($row->dem_5)?$row->dem_5:"")))?></p>
				<?=form_label('6. Which of the following age brackets do you sit in?')?>
				<p>Jawab : <?=form_dropdown('dem_6',dropnum(5),set_value('dem_6',(isset($row->dem_6)?$row->dem_6:"")))?></p>
			</div>	
		</div>	
	</div>	
</div>	
<div class="panel panel-default">
	<div class="panel-footer">
		<?php if($this->session->userdata('user_level')<>3){?>
		<?=form_checkbox('audit','Y',set_value('audit',(isset($row->audit) && $row->audit=='Y'?$row->audit:'')))?> Audit
		<?=form_checkbox('salah','Y',set_value('salah',(isset($row->salah) && $row->salah=='Y'?$row->salah:'')))?> Salah
		<?php }?>
		<button class="btn btn-primary btn-sm" type="submit" onclick="return confirm('You sure')"><span class="glyphicon glyphicon-save"></span> Save</button>
	</div>	
</div>	
<?=form_close()?>
