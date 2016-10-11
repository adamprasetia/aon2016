<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_app');
		$this->load->model('mdl_divisi');
		$this->load->model('mdl_vendor');
	}
	function index(){
		$offset = $this->lib_general->value_get('offset',0);
		$limit = $this->lib_general->value_get('limit',10);

		$data['title'] = APP_NAME.' - List';
		$data['action'] = site_url('app/search'.$this->_filter());
		$data['export'] = ($this->session->userdata('user_level')<>'3'?anchor('app/export'.$this->_filter(),'Export',array('class'=>'btn btn-primary btn-sm')):"");
		$this->table->set_template(tbl_tmp());
		
		$head_data = array(
			'country'=>'Country'
			,'code'=>'Code'
			,'quesioner'=>'Quesioner'
			,'com_1'=>'Kom1'
			,'com_2'=>'Kom2'
			,'dem_1'=>'Dem1'
			,'dem_2'=>'Dem2'
			,'dem_3'=>'Dem3'
			,'dem_4'=>'Dem4'
			,'dem_5'=>'Dem5'
			,'dem_6'=>'Dem6'
			,'fullname'=>'User Entry'
			,'audit'=>'Audit'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('app'.$this->_filter(array('order_column'=>$r,'order_type'=>$this->lib_general->order_type($r))),$value." ".$this->lib_general->order_icon($r));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->mdl_app->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,$r->country
				,$r->code
				,str_replace(',', ' ', $r->quesioner)
				,$r->com_1	
				,$r->com_2	
				,$r->divisi_no.','.$r->posisi_no
				,($r->dem_2<>0?$r->dem_2:'')
				,($r->dem_3<>0?$r->dem_3:'')
				,($r->dem_4<>0?$r->dem_4:'')
				,($r->dem_5<>0?$r->dem_5:'')
				,($r->dem_6<>0?$r->dem_6:'')
				,$r->fullname
				,$r->audit
				,anchor('app/edit/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-edit"></span> Edit')
			);
		}
		$data['table'] = $this->table->generate();
		$total = $this->mdl_app->count_all();
		
		$config = pag_tmp();
		$config['base_url'] = site_url("app".$this->_filter());
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = 'Showing '.($offset+1).' to '.($offset+$limit).' of '.number_format($total).' entries';
		$this->lib_general->display('app',$data);
	}	
	function _set_rules(){
		$this->form_validation->set_rules('code','Form Code','trim|required|callback__check_double');
		for($i=1;$i<=55;$i++){
			$this->form_validation->set_rules('q'.$i,'Q-'.$i,'trim');
		}
		$this->form_validation->set_rules('com_1','Comment 1','trim|callback__check_blank');
		$this->form_validation->set_rules('com_2','Comment 2','trim');
		$this->form_validation->set_rules('dem_1','Demographic 1','trim');
		$this->form_validation->set_rules('dem_2','Demographic 2','trim');
		$this->form_validation->set_rules('dem_3','Demographic 3','trim');
		$this->form_validation->set_rules('dem_4','Demographic 4','trim');
		$this->form_validation->set_rules('dem_5','Demographic 5','trim');
		$this->form_validation->set_rules('dem_6','Demographic 6','trim');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}
	function _check_double(){
		$code = $this->input->post('code');
		$country = $this->input->post('country');
		$result = $this->mdl_app->check_double($code,$country);
		if($this->uri->segment(2)=='add'){
			if($result->num_rows()>0){
				$this->form_validation->set_message('_check_double', 'Form code sudah terdaftar');
				return false;
			}else{
				return true;
			}
		}else if($this->uri->segment(2)=='edit'){
			if($result->num_rows()>0 && $result->row()->id <> $this->uri->segment(3)){
				$this->form_validation->set_message('_check_double', 'Form code sudah terdaftar');
				return false;
			}else{
				return true;
			}
		}
	}	
	function _check_blank(){
		for($i=1;$i<=55;$i++){
			if ($this->input->post('q'.$i)<>''){
				return true;	
			}
		}		
		$data = array('com_1','com_2','dem_1','dem_2','dem_3','dem_4','dem_5','dem_6');
		foreach($data as $r){
			if ($this->input->post($r)<>''){
				return true;	
			}			
		}
		$this->form_validation->set_message('_check_blank', 'Formulir Kosong Bro!!!');
		return false;
	}
	function _field(){
		$quesioner = '';
		for($i=1;$i<=55;$i++){
			$quesioner .= $this->input->post('q'.$i).',';
		}
		$data = array(
			'country'=>$this->input->post('country')
			,'code'=>$this->input->post('code')
			,'quesioner'=>$quesioner
			,'com_1'=>$this->input->post('com_1')
			,'com_2'=>$this->input->post('com_2')
			,'dem_1'=>$this->input->post('dem_1')
			,'dem_2'=>$this->input->post('dem_2')
			,'dem_3'=>$this->input->post('dem_3')
			,'dem_4'=>$this->input->post('dem_4')
			,'dem_5'=>$this->input->post('dem_5')
			,'dem_6'=>$this->input->post('dem_6')
			,'audit'=>$this->input->post('audit')
			,'salah'=>$this->input->post('salah')
		);
		return $data;		
	}
	function add($country='ID'){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = APP_NAME.' - Entry';
			$data['heading'] = 'Entry';
			$data['action'] = 'app/add/'.$country;
			$this->lib_general->display('app_form_'.$country,$data);
		}else{
			$data = $this->_field();
			$data['user_create']=$this->session->userdata('user_login');
			$data['date_create']=date('Y-m-d H:i:s');
			$this->mdl_app->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Entry Success</div>');
			redirect('app/add/'.$country.'?code='.($this->input->post('code')+1));
		}
	}
	function edit($id){
		$this->_check_edit($id);
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = APP_NAME.' - Update';
			$data['heading'] = 'Update';
			$data['action'] = 'app/edit/'.$id;
			$data['row'] = $this->mdl_app->get_from_field('id',$id)->row();
			$data['quesioner'] = explode(',',$data['row']->quesioner);
			$this->lib_general->display('app_form_'.$data['row']->country,$data);
		}else{
			$data = $this->_field();
			$data['user_update']=$this->session->userdata('user_login');
			$data['date_update']=date('Y-m-d H:i:s');
			$this->mdl_app->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Update Success</div>');
			redirect('app/edit/'.$id);
		}
	}
	function _check_edit($id){
		$app = $this->mdl_app->get_from_field('id',$id)->row();	
		if($this->session->userdata('user_level')==3){
			if($app->user_create<>$this->session->userdata('user_login')){
				redirect('app');
			}
		}
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
			,'de'=>$this->input->post('de')
			,'date_from'=>$this->input->post('date_from')
			,'date_to'=>$this->input->post('date_to')
			,'country'=>$this->input->post('country')
			,'vendor'=>$this->input->post('vendor')
		);
		redirect('app'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('order_column'=>0,'order_type'=>0,'limit'=>0,'offset'=>0,'search'=>0,'de'=>0,'date_from'=>0,'date_to'=>0,'country'=>0,'vendor'=>0);
		$result = array_diff_key($data,$add);
		foreach($result as $r => $val){			
			if($this->input->get($r)<>''){
				$str .="&$r=".$this->input->get($r);
			}
		}
		if($add<>''){
			foreach($add as $r => $val){
				$str .="&$r=".$val;
			}
		}
		return $str;
	}	
	function export(){
		$country = $this->input->get('country');
		ini_set('memory_limit','-1'); 

		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):'id');
		$order_type = ($this->input->get('order_type')<>''?$this->input->get('order_type'):'asc');
		
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('App List');		
		$active_sheet->getStyle("A1:BO1")->getFont()->setBold(true);

		$active_sheet->setCellValue('A1', 'responseid');
		$active_sheet->setCellValue('B1', 'respid');
		$active_sheet->setCellValue('C1', 'Date of entry');
		$active_sheet->setCellValue('D1', 'Q1 : Given the opportunity, I tell others great things about working here ( )');
		$active_sheet->setCellValue('E1', 'Q2 : I would not hesitate to recommend this organisation to a friend seeking employment ( )');
		$active_sheet->setCellValue('F1', 'Q3 : It would take a lot to get me to leave this organisation ( )');
		$active_sheet->setCellValue('G1', 'Q4 : I rarely think about leaving this organisation to work somewhere else ( )');
		$active_sheet->setCellValue('H1', 'Q5 : This organisation inspires me to do my best work every day ( )');
		$active_sheet->setCellValue('I1', 'Q6 : This organisation motivates me to contribute more than is normally required to complete my work ( )');
		$active_sheet->setCellValue('J1', 'Q7 : I confidently recommend our products to friends and family ( )');
		$active_sheet->setCellValue('K1', 'Q8 : This organisation has an excellent reputation in our community ( )');
		$active_sheet->setCellValue('L1', 'Q9 : I am proud to be part of this organisation ( )');
		$active_sheet->setCellValue('M1', 'Q10: This organisation delivers on its promises to our people ( )');
		$active_sheet->setCellValue('N1', 'Q11 : I can clearly explain what makes working here different from other organisations ( )');
		$active_sheet->setCellValue('O1', 'Q12 : This organisation is considered one of the best places to work for someone with my skills and experience ( )');
		$active_sheet->setCellValue('P1', 'Q13 : This is a socially and environmentally responsible organisation ( )');
		$active_sheet->setCellValue('Q1', 'Q14 : ^team()^ provides clear direction for the future  ( )');
		$active_sheet->setCellValue('R1', 'Q15 : ^team()^ makes good business decisions for the future ( )');
		$active_sheet->setCellValue('S1', 'Q16 : ^team()^ treats our people as the organisation\'s most valued asset ( )');
		$active_sheet->setCellValue('T1', 'Q17 : ^team()^  fills me with excitement for the future of this organisation ( )');
		$active_sheet->setCellValue('U1', 'Q18 : ^team()^  is appropriately visible and accessible to our people ( )');
		$active_sheet->setCellValue('V1', 'Q19 : ^team()^  is open and transparent in communication ( )');
		$active_sheet->setCellValue('W1', 'Q20 : At this organisation, we take a straight forward approach to doing work ( )');
		$active_sheet->setCellValue('X1', 'Q21 : At this organisation, we are open and transparent with each other  ( )');
		$active_sheet->setCellValue('Y1', 'Q22: At this organisation, we consider the impact of our decisions on both today and tomorrow ( )');
		$active_sheet->setCellValue('Z1', 'Q23: At this organisation, we take the initiative to solve problems ( )');
		$active_sheet->setCellValue('AA1', 'Q24 : At this organisation, we own the outcomes of our decisions  ( )');
		$active_sheet->setCellValue('AB1', 'Q25 : There are sufficient opportunities to progress my career beyond promotion (e.g. cross functional moves, secondments, project work) ( )');
		$active_sheet->setCellValue('AC1', 'Q26 : We promote the people best equipped to meet the future needs of the organisation ( )');
		$active_sheet->setCellValue('AD1', 'Q27: This organisation strongly supports the learning and development of our people ( )');
		$active_sheet->setCellValue('AE1', 'Q28 : This organisation offers excellent career opportunities to people who are strong performers ( )');
		$active_sheet->setCellValue('AF1', 'Q29 : Our leaders are doing a good job of helping me understand the reasons for organisational change and the desired outcomes ( )');
		$active_sheet->setCellValue('AG1', 'Q30 : Major change initiatives are well managed at this organisation ( )');
		$active_sheet->setCellValue('AH1', 'Q31: There is effective collaboration between different businesses and departments across Coca-Cola Amatil ( )');
		$active_sheet->setCellValue('AI1', 'Q32 : There is effective collaboration between different departments and teams within my business ( )');
		$active_sheet->setCellValue('AJ1', 'Q33 : Communications that I receive help me to do a better job ( )');
		$active_sheet->setCellValue('AK1', 'Q34: I receive the information that is important to me in the right way ( )');
		$active_sheet->setCellValue('AL1', 'Q35 : I am confident these survey results will be acted upon ( )');
		$active_sheet->setCellValue('AM1', 'Q36 : At this organisation, my opinions count ( )');
		$active_sheet->setCellValue('AN1', 'Q37: I have sufficient influence and involvement in decisions about the work I do ( )');
		$active_sheet->setCellValue('AO1', 'Q38 : The tools and resources provided helps me to perform better ( )');
		$active_sheet->setCellValue('AP1', 'Q39 : I am encouraged to seek out innovative and creative solutions to help improve our organisation\'s performance ( )');
		$active_sheet->setCellValue('AQ1', 'Q40 : The work processes we have in place help me to perform better ( )');
		$active_sheet->setCellValue('AR1', 'Q41 : My direct leader communicates the vision and strategy for this organisation\'s success in a clear and inspiring way ( )');
		$active_sheet->setCellValue('AS1', 'Q42 : My direct leader provides valuable feedback throughout the year to help me improve my performance ( )');
		$active_sheet->setCellValue('AT1', 'Q43 : My direct leader agrees on clear expectations and goals with me ( )');
		$active_sheet->setCellValue('AU1', 'Q44: The way we manage performance here enables me to contribute as much as possible to our organisation\'s success ( )');
		$active_sheet->setCellValue('AV1', 'Q45 : I receive appropriate recognition (beyond my pay and benefits) for my contributions and accomplishments ( )');
		$active_sheet->setCellValue('AW1', 'Q46 : My performance has a significant impact on my pay ( )');
		$active_sheet->setCellValue('AX1', 'Q47 : Workplace safety is considered important here ( )');
		$active_sheet->setCellValue('AY1', 'Q48: I know what to do when I see a safety issue ( )');
		$active_sheet->setCellValue('AZ1', 'Q49 : My direct leader demonstrates good safety leadership ( )');
		$active_sheet->setCellValue('BA1', 'Q50: I am excited about the plans that we have in place for the future ( )');
		$active_sheet->setCellValue('BB1', 'Q51 : I understand how my contributions relate to this organisation\'s goals ( )');
		$active_sheet->setCellValue('BC1', 'Q52: We have the strategies in place to achieve this organisation\'s vision ( )');
		$active_sheet->setCellValue('BD1', 'Q53 : The balance between my work and personal commitments is right for me ( )');
		$active_sheet->setCellValue('BE1', 'Q54 : This organisation has the policies and processes in place to support our people\'s wellbeing ( )');
		$active_sheet->setCellValue('BF1', 'Q55 : My direct leader actively role models managing their personal wellbeing ( )');
		$active_sheet->setCellValue('BG1', 'OE1 : - In a few words, please tell us:One thing you would change to make this organisation a better place to work');
		$active_sheet->setCellValue('BH1', 'OE2 : - What do you like best about working at this organisation');
		$active_sheet->setCellValue('BI1', 'Demog 1 - Business Department');
		$active_sheet->setCellValue('BJ1', 'Demog 1a - Business team');
		if ($country == 'ID') {
			$active_sheet->setCellValue('BK1', 'Demog 2 - Type of Job');		
			$active_sheet->setCellValue('BL1', 'Demog 3 - Tenure Banding');
			$active_sheet->setCellValue('BM1', 'Demog 4 - Employment Status');
		}else{
			$active_sheet->setCellValue('BK1', 'Demog 2 - location');		
			$active_sheet->setCellValue('BL1', 'Demog 3 - Type of Job');
			$active_sheet->setCellValue('BM1', 'Demog 4 - Tenure Banding');
		}
		$active_sheet->setCellValue('BN1', 'Demog 5 - Gender');
		$active_sheet->setCellValue('BO1', 'Demog 6 - Age');
		$active_sheet->setCellValue('BP1', 'Audit');
		$active_sheet->setCellValue('BQ1', 'Salah');
		$active_sheet->setCellValue('BR1', 'User Entry');
		$active_sheet->setCellValue('BS1', 'Date Entry');
		$active_sheet->setCellValue('BT1', 'Country');
		$result = $this->mdl_app->export()->result();
		$i=2;
		foreach($result as $r){
			$quesioner = explode(',',$r->quesioner);
			$active_sheet->setCellValue('A'.$i, $r->code);
			$active_sheet->setCellValue('B'.$i, '');
			$active_sheet->setCellValue('C'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->date_create)));
			$active_sheet->getStyle('C'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   			
			$active_sheet->setCellValue('D'.$i, ex_quesioner($quesioner[1-1]));
			$active_sheet->setCellValue('E'.$i, ex_quesioner($quesioner[2-1]));
			$active_sheet->setCellValue('F'.$i, ex_quesioner($quesioner[3-1]));
			$active_sheet->setCellValue('G'.$i, ex_quesioner($quesioner[4-1]));
			$active_sheet->setCellValue('H'.$i, ex_quesioner($quesioner[5-1]));
			$active_sheet->setCellValue('I'.$i, ex_quesioner($quesioner[6-1]));
			$active_sheet->setCellValue('J'.$i, ex_quesioner($quesioner[7-1]));
			$active_sheet->setCellValue('K'.$i, ex_quesioner($quesioner[8-1]));
			$active_sheet->setCellValue('L'.$i, ex_quesioner($quesioner[9-1]));
			$active_sheet->setCellValue('M'.$i, ex_quesioner($quesioner[10-1]));
			$active_sheet->setCellValue('N'.$i, ex_quesioner($quesioner[11-1]));
			$active_sheet->setCellValue('O'.$i, ex_quesioner($quesioner[12-1]));
			$active_sheet->setCellValue('P'.$i, ex_quesioner($quesioner[13-1]));
			$active_sheet->setCellValue('Q'.$i, ex_quesioner($quesioner[14-1]));
			$active_sheet->setCellValue('R'.$i, ex_quesioner($quesioner[15-1]));
			$active_sheet->setCellValue('S'.$i, ex_quesioner($quesioner[16-1]));
			$active_sheet->setCellValue('T'.$i, ex_quesioner($quesioner[17-1]));
			$active_sheet->setCellValue('U'.$i, ex_quesioner($quesioner[18-1]));
			$active_sheet->setCellValue('V'.$i, ex_quesioner($quesioner[19-1]));
			$active_sheet->setCellValue('W'.$i, ex_quesioner($quesioner[20-1]));
			$active_sheet->setCellValue('X'.$i, ex_quesioner($quesioner[21-1]));
			$active_sheet->setCellValue('Y'.$i, ex_quesioner($quesioner[22-1]));
			$active_sheet->setCellValue('Z'.$i, ex_quesioner($quesioner[23-1]));
			$active_sheet->setCellValue('AA'.$i, ex_quesioner($quesioner[24-1]));
			$active_sheet->setCellValue('AB'.$i, ex_quesioner($quesioner[25-1]));
			$active_sheet->setCellValue('AC'.$i, ex_quesioner($quesioner[26-1]));
			$active_sheet->setCellValue('AD'.$i, ex_quesioner($quesioner[27-1]));
			$active_sheet->setCellValue('AE'.$i, ex_quesioner($quesioner[28-1]));
			$active_sheet->setCellValue('AF'.$i, ex_quesioner($quesioner[29-1]));
			$active_sheet->setCellValue('AG'.$i, ex_quesioner($quesioner[30-1]));
			$active_sheet->setCellValue('AH'.$i, ex_quesioner($quesioner[31-1]));
			$active_sheet->setCellValue('AI'.$i, ex_quesioner($quesioner[32-1]));
			$active_sheet->setCellValue('AJ'.$i, ex_quesioner($quesioner[33-1]));
			$active_sheet->setCellValue('AK'.$i, ex_quesioner($quesioner[34-1]));
			$active_sheet->setCellValue('AL'.$i, ex_quesioner($quesioner[35-1]));
			$active_sheet->setCellValue('AM'.$i, ex_quesioner($quesioner[36-1]));
			$active_sheet->setCellValue('AN'.$i, ex_quesioner($quesioner[37-1]));
			$active_sheet->setCellValue('AO'.$i, ex_quesioner($quesioner[38-1]));
			$active_sheet->setCellValue('AP'.$i, ex_quesioner($quesioner[39-1]));
			$active_sheet->setCellValue('AQ'.$i, ex_quesioner($quesioner[40-1]));
			$active_sheet->setCellValue('AR'.$i, ex_quesioner($quesioner[41-1]));
			$active_sheet->setCellValue('AS'.$i, ex_quesioner($quesioner[42-1]));
			$active_sheet->setCellValue('AT'.$i, ex_quesioner($quesioner[43-1]));
			$active_sheet->setCellValue('AU'.$i, ex_quesioner($quesioner[44-1]));
			$active_sheet->setCellValue('AV'.$i, ex_quesioner($quesioner[45-1]));
			$active_sheet->setCellValue('AW'.$i, ex_quesioner($quesioner[46-1]));
			$active_sheet->setCellValue('AX'.$i, ex_quesioner($quesioner[47-1]));
			$active_sheet->setCellValue('AY'.$i, ex_quesioner($quesioner[48-1]));
			$active_sheet->setCellValue('AZ'.$i, ex_quesioner($quesioner[49-1]));
			$active_sheet->setCellValue('BA'.$i, ex_quesioner($quesioner[50-1]));
			$active_sheet->setCellValue('BB'.$i, ex_quesioner($quesioner[51-1]));
			$active_sheet->setCellValue('BC'.$i, ex_quesioner($quesioner[52-1]));
			$active_sheet->setCellValue('BD'.$i, ex_quesioner($quesioner[53-1]));
			$active_sheet->setCellValue('BE'.$i, ex_quesioner($quesioner[54-1]));
			$active_sheet->setCellValue('BF'.$i, ex_quesioner($quesioner[55-1]));
			$active_sheet->setCellValue('BG'.$i, strtolower($r->com_1));
			$active_sheet->setCellValue('BH'.$i, strtolower($r->com_2));
			$active_sheet->setCellValue('BI'.$i, $r->divisi_no.' - '.$r->divisi);
			$active_sheet->setCellValue('BJ'.$i, $r->posisi_no.' - '.$r->posisi);
			if ($r->country=='ID') {
				$active_sheet->setCellValue('BK'.$i, ($r->dem_2<>0?ex_dem_2_id($r->dem_2):""));
				$active_sheet->setCellValue('BL'.$i, ($r->dem_3<>0?ex_dem_3_id($r->dem_3):""));
				$active_sheet->setCellValue('BM'.$i, ($r->dem_4<>0?ex_dem_4_id($r->dem_4):""));
				$active_sheet->setCellValue('BN'.$i, ($r->dem_5<>0?ex_dem_5_id($r->dem_5):""));
				$active_sheet->setCellValue('BO'.$i, ($r->dem_6<>0?ex_dem_6_id($r->dem_6):""));				
			}else if ($r->country=='EN'){
				$active_sheet->setCellValue('BK'.$i, ($r->dem_2<>0?ex_dem_2_en($r->dem_2):""));
				$active_sheet->setCellValue('BL'.$i, ($r->dem_3<>0?ex_dem_3_en($r->dem_3):""));
				$active_sheet->setCellValue('BM'.$i, ($r->dem_4<>0?ex_dem_4_en($r->dem_4):""));
				$active_sheet->setCellValue('BN'.$i, ($r->dem_5<>0?ex_dem_5_en($r->dem_5):""));
				$active_sheet->setCellValue('BO'.$i, ($r->dem_6<>0?ex_dem_6_en($r->dem_6):""));				
			}	
			$active_sheet->setCellValue('BP'.$i, $r->audit);
			$active_sheet->setCellValue('BQ'.$i, $r->salah);
			$active_sheet->setCellValue('BR'.$i, $r->fullname);
			$active_sheet->setCellValue('BS'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->date_create)));
			$active_sheet->getStyle('BS'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('BT'.$i, $r->country);
			$i++;
		}

		$filename='LIST_APP_'.date('Ymd_His').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
							 
		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
		$objWriter->save('php://output');
	}	
}