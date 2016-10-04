<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Welcome to <?=APP_NAME?></title>
	<link href="<?=base_url('../assets/img/favicon.ico')?>" rel="shortcut icon" type="image/x-icon"/>	
	
	<link href="<?=base_url('../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet"/>
</head>
<body>
	<div class="container">
  	<div class="row">
  		<div class="col-md-offset-3 col-md-6">
				<nav class="navbar navbar-default">
						<div class="navbar-header">
							<?=anchor('dashboard',APP_NAME,array('class'=>'navbar-brand'))?>
						</div>
				</nav>	
				<ol class="breadcrumb">
					<li><?=anchor('login','Login')?></li>
					<li class="active">Registration</li>
				</ol>
				<?=$this->session->flashdata('alert')?>
			</div>
		</div>
	</div>
	<?=form_open('reg')?>
  <div class="container">
  	<div class="row">
  		<div class="col-md-offset-3 col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<?=validation_errors()?>
						<div class="form-group">
							<?=form_label('Fullname')?>
							<?=form_input(array('name'=>'fullname','maxlength'=>'50','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('fullname',''),'required'=>'required','autofocus'=>'autofocus'))?>
						</div>
						<div class="form-group">
							<?=form_label('Username')?>
							<?=form_input(array('name'=>'username','maxlength'=>'50','class'=>'form-control input-sm','autocomplete'=>'off','value'=>set_value('username',''),'required'=>'required'))?>
						</div>
						<div class="form-group">
							<?=form_label('Password')?>
							<?=form_password(array('name'=>'password','maxlength'=>'50','class'=>'form-control input-sm','autocomplete'=>'off','value'=>'','required'=>'required'))?>
						</div>
						<div class="form-group">
							<?=form_label('Confirm Password')?>
							<?=form_password(array('name'=>'con_password','maxlength'=>'50','class'=>'form-control input-sm','autocomplete'=>'off','value'=>'','required'=>'required'))?>
						</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Register</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?=form_close()?>
</body>
</html>
