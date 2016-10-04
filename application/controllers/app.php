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
			,'vendor_name'=>'Vendor'
			,'vendor_code'=>'Vendor Code'
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
				,$r->vendor_name
				,$r->vendor_code
				,$r->code
				,$r->quesioner
				,$r->com_1	
				,$r->com_2	
				,($r->dem_1<>0?$r->dem_1:'')
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
		$this->form_validation->set_rules('vendor','Vendor','trim|required');
		$this->form_validation->set_rules('vendor_code','Vendor Code','trim');
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
			,'vendor'=>$this->input->post('vendor')
			,'vendor_code'=>$this->input->post('vendor_code')
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
			redirect('app/add/'.$country);
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
		ini_set('memory_limit','-1'); 

		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):'id');
		$order_type = ($this->input->get('order_type')<>''?$this->input->get('order_type'):'asc');
		
		require_once "../assets/phpexcel/PHPExcel.php";
		$excel = new PHPExcel();
		
		$excel->setActiveSheetIndex(0);
		$active_sheet = $excel->getActiveSheet();
		$active_sheet->setTitle('App List');		
		$active_sheet->getStyle("A1:BR1")->getFont()->setBold(true);

		$active_sheet->setCellValue('A1', 'Vendor');
		$active_sheet->setCellValue('B1', 'Code');
		$active_sheet->setCellValue('C1', 'Q1');
		$active_sheet->setCellValue('D1', 'Q2');
		$active_sheet->setCellValue('E1', 'Q3');
		$active_sheet->setCellValue('F1', 'Q4');
		$active_sheet->setCellValue('G1', 'Q5');
		$active_sheet->setCellValue('H1', 'Q6');
		$active_sheet->setCellValue('I1', 'Q7');
		$active_sheet->setCellValue('J1', 'Q8');
		$active_sheet->setCellValue('K1', 'Q9');
		$active_sheet->setCellValue('L1', 'Q10');
		$active_sheet->setCellValue('M1', 'Q11');
		$active_sheet->setCellValue('N1', 'Q12');
		$active_sheet->setCellValue('O1', 'Q13');
		$active_sheet->setCellValue('P1', 'Q14');
		$active_sheet->setCellValue('Q1', 'Q15');
		$active_sheet->setCellValue('R1', 'Q16');
		$active_sheet->setCellValue('S1', 'Q17');
		$active_sheet->setCellValue('T1', 'Q18');
		$active_sheet->setCellValue('U1', 'Q19');
		$active_sheet->setCellValue('V1', 'Q20');
		$active_sheet->setCellValue('W1', 'Q21');
		$active_sheet->setCellValue('X1', 'Q22');
		$active_sheet->setCellValue('Y1', 'Q23');
		$active_sheet->setCellValue('Z1', 'Q24');
		$active_sheet->setCellValue('AA1', 'Q25');
		$active_sheet->setCellValue('AB1', 'Q26');
		$active_sheet->setCellValue('AC1', 'Q27');
		$active_sheet->setCellValue('AD1', 'Q28');
		$active_sheet->setCellValue('AE1', 'Q29');
		$active_sheet->setCellValue('AF1', 'Q30');
		$active_sheet->setCellValue('AG1', 'Q31');
		$active_sheet->setCellValue('AH1', 'Q32');
		$active_sheet->setCellValue('AI1', 'Q33');
		$active_sheet->setCellValue('AJ1', 'Q34');
		$active_sheet->setCellValue('AK1', 'Q35');
		$active_sheet->setCellValue('AL1', 'Q36');
		$active_sheet->setCellValue('AM1', 'Q37');
		$active_sheet->setCellValue('AN1', 'Q38');
		$active_sheet->setCellValue('AO1', 'Q39');
		$active_sheet->setCellValue('AP1', 'Q40');
		$active_sheet->setCellValue('AQ1', 'Q41');
		$active_sheet->setCellValue('AR1', 'Q42');
		$active_sheet->setCellValue('AS1', 'Q43');
		$active_sheet->setCellValue('AT1', 'Q44');
		$active_sheet->setCellValue('AU1', 'Q45');
		$active_sheet->setCellValue('AV1', 'Q46');
		$active_sheet->setCellValue('AW1', 'Q47');
		$active_sheet->setCellValue('AX1', 'Q48');
		$active_sheet->setCellValue('AY1', 'Q49');
		$active_sheet->setCellValue('AZ1', 'Q50');
		$active_sheet->setCellValue('BA1', 'Q51');
		$active_sheet->setCellValue('BB1', 'Q52');
		$active_sheet->setCellValue('BC1', 'Q53');
		$active_sheet->setCellValue('BD1', 'Q54');
		$active_sheet->setCellValue('BE1', 'Q55');
		$active_sheet->setCellValue('BF1', 'OE1');
		$active_sheet->setCellValue('BG1', 'OE2');
		$active_sheet->setCellValue('BH1', 'D1');
		$active_sheet->setCellValue('BI1', 'D2');
		$active_sheet->setCellValue('BJ1', 'D3');
		$active_sheet->setCellValue('BK1', 'D4');
		$active_sheet->setCellValue('BL1', 'D5');
		$active_sheet->setCellValue('BM1', 'D6');
		$active_sheet->setCellValue('BN1', 'AUDIT');
		$active_sheet->setCellValue('BO1', 'SALAH');
		$active_sheet->setCellValue('BP1', 'User Entry');
		$active_sheet->setCellValue('BQ1', 'Date Entry');
		$active_sheet->setCellValue('BR1', 'Country');
		$result = $this->mdl_app->export()->result();
		$i=2;
		foreach($result as $r){
			$quesioner = explode(',',$r->quesioner);
			$active_sheet->setCellValue('A'.$i, $r->vendor_name.' - '.$r->vendor_code);
			$active_sheet->setCellValue('B'.$i, $r->code);
			$active_sheet->setCellValue('C'.$i, $quesioner[1-1]);
			$active_sheet->setCellValue('D'.$i, $quesioner[2-1]);
			$active_sheet->setCellValue('E'.$i, $quesioner[3-1]);
			$active_sheet->setCellValue('F'.$i, $quesioner[4-1]);
			$active_sheet->setCellValue('G'.$i, $quesioner[5-1]);
			$active_sheet->setCellValue('H'.$i, $quesioner[6-1]);
			$active_sheet->setCellValue('I'.$i, $quesioner[7-1]);
			$active_sheet->setCellValue('J'.$i, $quesioner[8-1]);
			$active_sheet->setCellValue('K'.$i, $quesioner[9-1]);
			$active_sheet->setCellValue('L'.$i, $quesioner[10-1]);
			$active_sheet->setCellValue('M'.$i, $quesioner[11-1]);
			$active_sheet->setCellValue('N'.$i, $quesioner[12-1]);
			$active_sheet->setCellValue('O'.$i, $quesioner[13-1]);
			$active_sheet->setCellValue('P'.$i, $quesioner[14-1]);
			$active_sheet->setCellValue('Q'.$i, $quesioner[15-1]);
			$active_sheet->setCellValue('R'.$i, $quesioner[16-1]);
			$active_sheet->setCellValue('S'.$i, $quesioner[17-1]);
			$active_sheet->setCellValue('T'.$i, $quesioner[18-1]);
			$active_sheet->setCellValue('U'.$i, $quesioner[19-1]);
			$active_sheet->setCellValue('V'.$i, $quesioner[20-1]);
			$active_sheet->setCellValue('W'.$i, $quesioner[21-1]);
			$active_sheet->setCellValue('X'.$i, $quesioner[22-1]);
			$active_sheet->setCellValue('Y'.$i, $quesioner[23-1]);
			$active_sheet->setCellValue('Z'.$i, $quesioner[24-1]);
			$active_sheet->setCellValue('AA'.$i, $quesioner[25-1]);
			$active_sheet->setCellValue('AB'.$i, $quesioner[26-1]);
			$active_sheet->setCellValue('AC'.$i, $quesioner[27-1]);
			$active_sheet->setCellValue('AD'.$i, $quesioner[28-1]);
			$active_sheet->setCellValue('AE'.$i, $quesioner[29-1]);
			$active_sheet->setCellValue('AF'.$i, $quesioner[30-1]);
			$active_sheet->setCellValue('AG'.$i, $quesioner[31-1]);
			$active_sheet->setCellValue('AH'.$i, $quesioner[32-1]);
			$active_sheet->setCellValue('AI'.$i, $quesioner[33-1]);
			$active_sheet->setCellValue('AJ'.$i, $quesioner[34-1]);
			$active_sheet->setCellValue('AK'.$i, $quesioner[35-1]);
			$active_sheet->setCellValue('AL'.$i, $quesioner[36-1]);
			$active_sheet->setCellValue('AM'.$i, $quesioner[37-1]);
			$active_sheet->setCellValue('AN'.$i, $quesioner[38-1]);
			$active_sheet->setCellValue('AO'.$i, $quesioner[39-1]);
			$active_sheet->setCellValue('AP'.$i, $quesioner[40-1]);
			$active_sheet->setCellValue('AQ'.$i, $quesioner[41-1]);
			$active_sheet->setCellValue('AR'.$i, $quesioner[42-1]);
			$active_sheet->setCellValue('AS'.$i, $quesioner[43-1]);
			$active_sheet->setCellValue('AT'.$i, $quesioner[44-1]);
			$active_sheet->setCellValue('AU'.$i, $quesioner[45-1]);
			$active_sheet->setCellValue('AV'.$i, $quesioner[46-1]);
			$active_sheet->setCellValue('AW'.$i, $quesioner[47-1]);
			$active_sheet->setCellValue('AX'.$i, $quesioner[48-1]);
			$active_sheet->setCellValue('AY'.$i, $quesioner[49-1]);
			$active_sheet->setCellValue('AZ'.$i, $quesioner[50-1]);
			$active_sheet->setCellValue('BA'.$i, $quesioner[51-1]);
			$active_sheet->setCellValue('BB'.$i, $quesioner[52-1]);
			$active_sheet->setCellValue('BC'.$i, $quesioner[53-1]);
			$active_sheet->setCellValue('BD'.$i, $quesioner[54-1]);
			$active_sheet->setCellValue('BE'.$i, $quesioner[55-1]);
			$active_sheet->setCellValue('BF'.$i, strtolower($r->com_1));
			$active_sheet->setCellValue('BG'.$i, strtolower($r->com_2));
			$active_sheet->setCellValue('BH'.$i, ($r->dem_1<>0?$r->dem_1:""));
			$active_sheet->setCellValue('BI'.$i, ($r->dem_2<>0?$r->dem_2:""));
			$active_sheet->setCellValue('BJ'.$i, ($r->dem_3<>0?$r->dem_3:""));
			$active_sheet->setCellValue('BK'.$i, ($r->dem_4<>0?$r->dem_4:""));
			$active_sheet->setCellValue('BL'.$i, ($r->dem_5<>0?$r->dem_5:""));
			$active_sheet->setCellValue('BM'.$i, ($r->dem_6<>0?$r->dem_6:""));
			$active_sheet->setCellValue('BN'.$i, $r->audit);
			$active_sheet->setCellValue('BO'.$i, $r->salah);
			$active_sheet->setCellValue('BP'.$i, $r->fullname);
			$active_sheet->setCellValue('BQ'.$i, PHPExcel_Shared_Date::PHPToExcel(date_to_excel($r->date_create)));
			$active_sheet->getStyle('BQ'.$i)->getNumberFormat()->setFormatCode('dd/mm/yyyy');		   
			$active_sheet->setCellValue('BR'.$i, $r->country);
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