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
			<?=form_label('New Password')?>
			<?=form_password(array('name'=>'password','maxlength'=>'50','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('password',''),'required'=>'required','autofocus'=>'autofocus'))?>
		</div>
		<div class="form-group">
			<?=form_label('Confirm Password')?>
			<?=form_password(array('name'=>'password_conf','maxlength'=>'50','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('password_conf',''),'required'=>'required'))?>
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-danger btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
	</div>	
</div>
<?=form_close()?>
