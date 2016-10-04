<section class="content">
  <div class="row">
		<div class="col-lg-3 col-xs-6">
		  <div class="small-box bg-aqua">
			<div class="inner">
			  <h3><?=$total?></h3>
			  <p>Quesioner yang sudah dientry</p>
			</div>
			<div class="icon">
			  <i class="ion ion-document"></i>
			</div>
		  </div>
		</div>
		<?php if($this->session->userdata('user_level')<>3){ ?>
		<div class="col-lg-3 col-xs-6">
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3><?=$total_id?></h3>
			  <p>Quesioner Indonesia</p>
			</div>
			<div class="icon">
			  <i class="ion ion-document-text"></i>
			</div>
		  </div>
		</div>
		<div class="col-lg-3 col-xs-6">
		  <div class="small-box bg-yellow">
			<div class="inner">
			  <h3><?=$total_en?></h3>
			  <p>Quesioner Inggris</p>
			</div>
			<div class="icon">
			  <i class="ion ion-document-text"></i>
			</div>
		  </div>
		</div>
		<div class="col-lg-3 col-xs-6">
		  <div class="small-box bg-red">
			<div class="inner">
			  <h3><?=$de?></h3>
			  <p>Data Entry</p>
			</div>
			<div class="icon">
			  <i class="ion ion-person"></i>
			</div>
		  </div>
		</div>
		<?php } ?>
	</div>

	<div class="row">
		<div class="col-md-<?=($this->session->userdata('user_level')<>3?6:12)?>">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Populate Entry</h3>
				</div>
				<div class="box-body chart-responsive">
					<div class="chart" id="pop-entry-chart" style="height: 300px;"></div>
				</div>
			</div>
		</div>
		<?php if($this->session->userdata('user_level')<>3){ ?>
		<div class="col-md-6">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Data Entry</h3>
				</div>
				<div class="box-body chart-responsive">
					<div class="chart" id="pop-de-chart" style="height: 300px;"></div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>	
</section>
<script src="<?=base_url('../assets/js/jquery-1.11.3.min.js')?>"></script>
<script src="<?=base_url('../assets/AdminLTE-2.1.1/plugins/morris/raphael-min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('../assets/AdminLTE-2.1.1/plugins/morris/morris.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){	  
	$.ajax({    
		url: '<?=base_url("index.php/chart/pop_entry")?>',
		dataType: "json",
		success: function(str) {    
			Morris.Line({  
				element: 'pop-entry-chart',
				resize: true,
				data: str,
				xkey: 'y',
				ykeys: ['jumlah'],
				labels: ['Jumlah'],
				lineColors: ["#3c8dbc"],
				hideHover: 'auto'
			});  
		}		
	});	  
	$.ajax({    
		url: '<?=base_url("index.php/chart/pop_de")?>',
		dataType: "json",
		success: function(str) {    
			Morris.Bar({  
				element: 'pop-de-chart',
				resize: true,
				data: str,
				xkey: 'de',
				ykeys: ['jumlah'],
				labels: ['Jumlah'],
				barColors: ["#00a65a"],
				hideHover: 'auto'
			});  
		}		
	});	  
});
</script>
