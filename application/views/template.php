<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?=$title?></title>
	<link href="<?=base_url('../assets/img/favicon.ico')?>" rel="shortcut icon" type="image/x-icon"/>	
	
	<link href="<?=base_url('../assets/jquery-ui-1.11.2.custom/jquery-ui.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/AdminLTE-2.1.1/dist/css/AdminLTE.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('assets/css/sticky-footer.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet"/>

	<link href="<?=base_url('../assets/font-awesome-4.3.0/css/font-awesome.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/ionicons-2.0.1/css/ionicons.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/AdminLTE-2.1.1/plugins/morris/morris.css')?>" type="text/css" rel="stylesheet"/>
</head>
<body>
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?=anchor('dashboard',APP_NAME,array('class'=>'navbar-brand'))?>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<?=$menu?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><?=$username?></a></li>
						<li><?=anchor('login/logout','Logout')?></li>
					</ul>
				</div>
			</div>
		</nav>

	<div class="container-fluid">
		<?=$content?>
	</div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright &copy; 2016 ADirect</p>
    </div>
  </footer>

	<script src="<?=base_url('../assets/js/jquery-1.11.3.min.js')?>"></script>
	<script src="<?=base_url('../assets/jquery-ui-1.11.2.custom/jquery-ui.min.js')?>"></script>
	<script src="<?=base_url('../assets/bootstrap-3.3.4-dist/js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('assets/js/general.js')?>"></script>
	</body>
</html>