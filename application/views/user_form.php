<ol class="breadcrumb">
  <li><?=anchor('dashboard','Dashboard')?></li>
  <li><?=anchor('user','User Management')?></li>
  <li class="active"><?=$heading?></li>
</ol>
<?=$this->session->flashdata('alert')?>
<?=form_open($action)?>
<div class="panel panel-default">
	<div class="panel-body">
		<?=validation_errors()?>
		<div class="form-group">
			<?=form_label('Fullname')?>
			<?=form_input(array('name'=>'fullname','maxlength'=>'50','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('fullname',(isset($row->fullname)?$row->fullname:'')),'required'=>'required','autofocus'=>'autofocus'))?>
		</div>
		<div class="form-group">
			<?=form_label('Username')?>
			<?=form_input(array('name'=>'username','maxlength'=>'50','placeholder'=>'Username','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('username',(isset($row->username)?$row->username:'')),'required'=>'required'))?>
		</div>
		<div class="form-group">
			<?=form_label('Password','password',array('class'=>'control-label'))?>
			<?=form_input(array('name'=>'password','class'=>'form-control input-sm','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('password',(isset($row->password)?$row->password:'')),'required'=>'required'))?>
		</div>		
		<div class="form-group">
			<?=form_label('Level')?>
			<?=form_dropdown('level',level_dropdown(),set_value('level',(isset($row->level)?$row->level:'')),'required=required class=form-control input-sm')?>
		</div>
		<div class="form-group">
			<?=form_label('Status')?>
			<?=form_dropdown('status',status_dropdown(),set_value('status',(isset($row->status)?$row->status:'')),'required=required class=form-control input-sm')?>
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
	</div>	
</div>
<?=form_close()?>
