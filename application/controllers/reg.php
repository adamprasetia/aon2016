<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reg extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_user');
	}
	function _set_rules(){
		$this->form_validation->set_rules('fullname','Fullname','trim|required');
		$this->form_validation->set_rules('username','Username','trim|required|is_unique[user.username]');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('con_password','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}	
	function index(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$data['title'] = APP_NAME.' - New User';
			$data['heading'] = 'Registration';
			$this->load->view('reg',$data);
		}else{			
			$data = array(
				'fullname'=>$this->input->post('fullname')
				,'username'=>$this->input->post('username')
				,'password'=>$this->input->post('password')
				,'level'=>'3'
				,'status'=>'1'
				,'date_create'=>date('Y-m-d H:i:s')
			);
			$this->mdl_user->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">Registration Success</div>');
			redirect('reg');
		}		
	}
}