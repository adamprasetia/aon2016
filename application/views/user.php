<ol class="breadcrumb">
	<li><?=anchor('dashboard','Dashboard')?></li>
	<li class="active">Security</li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading">
		<?=$add_btn?>
	</div>
	<div class="panel-body">
		<?=form_open($action,array('class'=>'form-inline'))?>
			<div class="form-group">
				<?=form_label('Show entries','limit')?>
				<?=form_dropdown('limit',array('10'=>'10','50'=>'50','100'=>'100'),set_value('limit',$this->input->get('limit')),'onchange="submit()" class="form-control input-sm"')?> 
			</div>
			<div class="form-group">
				<?=form_input(array('name'=>'search','value'=>$this->input->get('search'),'autocomplete'=>'off','placeholder'=>'Search..','class'=>'form-control input-sm'))?>
			</div>			
		<?=form_close()?>
		<div class="table-responsive">
			<table class="table">
				<?=$table?>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		<?=form_label($total,'',array('class'=>'label-footer'))?>
		<div class="pull-right">
			<?=$pagination?>
		</div>
	</div>		
</div>
