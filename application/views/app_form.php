<?=$this->session->flashdata('alert')?>
<?=validation_errors()?>
<?=form_open($action)?>
<section class="content-header breadcrumb">
	Form Code : <?=form_input(array('name'=>'code','type'=>'number','maxlength'=>'10','autocomplete'=>'off','autofocus'=>'autofocus','value'=>set_value('code',(isset($row->code)?$row->code:""))))?>
	<ol class="breadcrumb">
	  <li class="active"><?=$heading?></li>
	  <li>User Entry : <b><?=$this->lib_general->get_username(isset($row->user_create)?$row->user_create:$this->session->userdata('user_login'))?></b></li>
	</ol>
</section>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				PERTANYAAN
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<?php for($i=1;$i<=10;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
					<div class="col-md-4">
						<?php for($i=11;$i<=21;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
					<div class="col-md-4">
						<?php for($i=22;$i<=31;$i++){?>
						<div class="form-group">
							<label class="label label-default"><?=$i?></label><?=form_dropdown('q'.$i,dropnum(6),set_value('q'.$i,(isset($quesioner[$i-1])?$quesioner[$i-1]:"")))?>
						</div>	
						<?php }?>
					</div>	
				</div>	
			</div>
		</div>		
	</div>	
	<div class="col-md-5">
		<div class="panel panel-primary">
			<div class="panel-heading">
				KOMENTAR
			</div>
			<div class="panel-body">
				<div class="form-group">
					<?=form_label('1. Satu hal yang akan anda ubah untuk membuat organisasi ini menjadi tempat kerja yang lebih baik')?>
					<?=form_textarea(array('name'=>'com_1','rows'=>'7','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('com_1',(isset($row->com_1)?$row->com_1:""))))?>
				</div><hr>
				<div class="form-group">
					<?=form_label('2. Apa yang paling anda sukai bekerja di organisasi ini')?>
					<?=form_textarea(array('name'=>'com_2','rows'=>'7','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('com_2',(isset($row->com_2)?$row->com_2:""))))?>
				</div>
			</div>
		</div>
	</div>	
	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				DEMOGRAPHIC PERTANYAAN
			</div>
			<div class="panel-body">
				<?=form_label('1. Di bagian manakah anda bekerja ?')?>
				<p>Jawab : <?=form_dropdown('dem_1',dropnum(8),set_value('dem_1',(isset($row->dem_1)?$row->dem_1:"")))?></p><hr>
				<?=form_label('2. Pilih kategori yang paling menggambarkan peran anda dalam organisasi')?>
				<p>Jawab : <?=form_dropdown('dem_2',dropnum(5),set_value('dem_2',(isset($row->dem_2)?$row->dem_2:"")))?></p><hr>
				<?=form_label('3. Masa kerja bersama organisasi')?>
				<p>Jawab : <?=form_dropdown('dem_3',dropnum(9),set_value('dem_3',(isset($row->dem_3)?$row->dem_3:"")))?></p><hr>
				<?=form_label('4. Manakah dari berikut ini yang paling menjelaskan status pekerjaan anda dalam organisasi')?>
				<p>Jawab : <?=form_dropdown('dem_4',dropnum(3),set_value('dem_4',(isset($row->dem_4)?$row->dem_4:"")))?></p><hr>
				<?=form_label('5. Jenis Kelamin')?>
				<p>Jawab : <?=form_dropdown('dem_5',dropnum(2),set_value('dem_5',(isset($row->dem_5)?$row->dem_5:"")))?></p>
			</div>	
		</div>	
	</div>	
</div>	
<div class="panel panel-default">
	<div class="panel-footer">
		<?php if($this->session->userdata('user_level')<>3){?>
		<?=form_checkbox('audit','Y',set_value('audit',(isset($row->audit) && $row->audit=='Y'?$row->audit:'')))?> Audit
		<?php }?>
		<button class="btn btn-primary btn-sm" type="submit" onclick="return confirm('You sure')"><span class="glyphicon glyphicon-save"></span> Save</button>
	</div>	
</div>	
<?=form_close()?>
