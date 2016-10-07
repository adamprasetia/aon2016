<ol class="breadcrumb">
	<li><?=anchor('dashboard','Dashboard')?></li>
	<li class="active">List</li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading"><?=$export?></div>
	<div class="panel-body">
		<?=form_open($action,array('class'=>'form-inline'))?>
			<div class="form-group">
				<?=form_label('Show entries','limit')?>
				<?=form_dropdown('limit',array('10'=>'10','50'=>'50','100'=>'100'),set_value('limit',$this->input->get('limit')),'onchange="submit()" class="form-control input-sm"')?> 
			</div>
			<div class="form-group">
				<?=form_input(array('name'=>'search','value'=>$this->input->get('search'),'autocomplete'=>'off','placeholder'=>'Search..','class'=>'form-control input-sm'))?>
			</div>			
			<div class="form-group">
				<?=form_dropdown('de',$this->mdl_user->de_dropdown(),set_value('de',$this->input->get('de')),'onchange="submit()" class="form-control input-sm"')?>
			</div>
			<div class="form-group">
				<?=form_input(array('name'=>'date_from','value'=>$this->input->get('date_from'),'autocomplete'=>'off','placeholder'=>'Entry Date From','class'=>'form-control input-sm input-date'))?>
			</div>			
			<div class="form-group">
				<?=form_input(array('name'=>'date_to','value'=>$this->input->get('date_to'),'autocomplete'=>'off','placeholder'=>'Entry Date To','class'=>'form-control input-sm input-date'))?>
			</div>			
			<div class="form-group">
				<?=form_dropdown('country',array(''=>'- Country -','ID'=>'Indonesia','EN'=>'Inggris'),set_value('country',$this->input->get('country')),'onchange="submit()" class="form-control input-sm"')?>
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
		<?=form_label($total,'',array('class'=>'label-footer'))?>
		<div class="pull-right">
			<?=$pagination?>
		</div>
	</div>		
</div>
