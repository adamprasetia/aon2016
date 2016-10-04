<ol class="breadcrumb">
	<li><?=anchor('dashboard','Dashboard')?></li>
	<li class="active">Fee</li>
</ol>
<div class="panel panel-default">
	<div class="panel-body">
		<?=form_open($action,array('class'=>'form-inline'))?>
			<div class="form-group">
				<?=form_input(array('name'=>'date_from','value'=>$this->input->get('date_from'),'autocomplete'=>'off','placeholder'=>'From','class'=>'form-control input-sm input-date'))?>
			</div>			
			<div class="form-group">
				<?=form_input(array('name'=>'date_to','value'=>$this->input->get('date_to'),'autocomplete'=>'off','placeholder'=>'To','class'=>'form-control input-sm input-date'))?>
			</div>			
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		<?=form_close()?>
		<div class="table-responsive">
			<table class="table">
				<?=$table?>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		<?=$btn_export?>
	</div>	
</div>
