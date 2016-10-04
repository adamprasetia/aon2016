<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_user');
		$this->load->helper('user_helper');
	}
	function index(){
		$offset = $this->lib_general->value_get('offset',0);
		$limit = $this->lib_general->value_get('limit',10);

		$data['title'] = APP_NAME.' - User Management';
		$data['action'] = site_url('user/search'.$this->_filter());
		$data['add_btn'] = anchor('user/add'.$this->_filter(),'<span class="glyphicon glyphicon-plus"></span> New User',array('class'=>'btn btn-primary btn-sm'));
		$this->table->set_template(tbl_tmp());
		
		$head_data = array(
			'fullname'=>'Fullname'
			,'username'=>'Username'
			,'level'=>'Level'
			,'ip_login'=>'Last IP Login'
			,'user_agent'=>'Last User Agent'
			,'date_login'=>'Last Login'			
			,'status'=>'Status'
		);
		$heading[] = 'No';
		foreach($head_data as $r => $value){
			$heading[] = anchor('user'.$this->_filter(array('order_column'=>$r,'order_type'=>$this->lib_general->order_type($r))),$value." ".$this->lib_general->order_icon($r));
		}		
		$heading[] = 'Action';
		$this->table->set_heading($heading);
		$result = $this->mdl_user->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				$i++
				,$r->fullname
				,$r->username	
				,get_level($r->level)
				,$r->ip_login
				,$r->user_agent
				,$r->date_login				
				,get_status($r->status)
				,anchor('user/edit/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-edit"></span> Edit')
				."&nbsp;|&nbsp;".anchor('user/delete/'.$r->id.$this->_filter(),'<span class="glyphicon glyphicon-trash"></span> Delete',array('onclick'=>"return confirm('Are you sure')"))
			);
		}
		$data['table'] = $this->table->generate();
		$total = $this->mdl_user->count_all();
		
		$config = pag_tmp();
		$config['base_url'] = site_url("user".$this->_filter());
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['total'] = 'Showing '.($offset+1).' to '.($offset+$limit).' of '.number_format($total).' entries';
		$this->lib_general->display('user',$data);
	}
	function _set_rules(){
		$this->form_validation->set_rules('fullname','Fullname','trim|required');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('level','Level','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	function _field(){
		$data = array(
			'fullname'=>$this->input->post('fullname')
			,'username'=>$this->input->post('username')
			,'password'=>$this->input->post('password')
			,'level'=>$this->input->post('level')
			,'status'=>$this->input->post('status')
			,'user_create'=>$this->session->userdata('user_login')
			,'date_create'=>date('Y-m-d H:i:s')
		);		
		return $data;
	}
	function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = APP_NAME.' - New User';
			$data['heading'] = 'New User';
			$data['action'] = 'user/add'.$this->_filter();
			$this->lib_general->display('user_form',$data);
		}else{			
			$data = $this->_field();
			$data['user_create']=$this->session->userdata('user_login');
			$data['date_create']=date('Y-m-d H:i:s');
			$this->mdl_user->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">User Added Complete</div>');
			redirect('user/add'.$this->_filter());
		}
	}
	function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){			
			$data['title'] = APP_NAME.' - Update User';
			$data['heading'] = 'Update User';
			$data['action'] = 'user/edit/'.$id.$this->_filter();
			$data['row'] = $this->mdl_user->get_from_field('id',$id)->row();
			$this->lib_general->display('user_form',$data);
		}else{			
			$data = $this->_field();
			$data['user_update']=$this->session->userdata('user_login');
			$data['date_update']=date('Y-m-d H:i:s');
			$this->mdl_user->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">User Updated Complete</div>');
			redirect('user/edit/'.$id.$this->_filter());
		}
	}
	function delete($id){		
		$this->mdl_user->delete($id);
		redirect('user'.$this->_filter());
	}
	function search(){
		$data = array(
			'search'=>$this->input->post('search')
			,'limit'=>$this->input->post('limit')
		);
		redirect('user'.$this->_filter($data));
	}
	function _filter($add = array()){
		$str = '?avenger=1';
		$data = array('order_column'=>0,'order_type'=>0,'limit'=>0,'offset'=>0,'search'=>0);
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
}