<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta"); 
		$this->load->model('mdl_user');
	}
	function index(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$this->load->view('login');
		}else{
			$user = $this->mdl_user->get_from_field('username',$username)->row();
			$this->_date_login($user->id);
			$this->session->set_userdata('user_login',$user->id);
			$this->session->set_userdata('user_level',$user->level);
			redirect('dashboard');
		}
	}
	function _date_login($id){
		$browser = getBrowser();
		$data = array(
			'ip_login'=>$_SERVER['REMOTE_ADDR']
			,'user_agent'=>$browser['platform']."(".$browser['name']." ".$browser['version'].")"
			,'date_login'=>date('Y-m-d H:i:s')
		);
		$this->mdl_user->edit($id,$data);
	}	
	function _set_rules(){
		$this->form_validation->set_rules('username','Username','required|trim|xss_clean|callback__login_check');
		$this->form_validation->set_rules('password','Password','required|trim|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	function _login_check(){
		$username = $this->input->post('username');
		$query = $this->mdl_user->get_from_field('username',$username);
		if($query->num_rows()>0){
			$password = $query->row()->password;
			$status = $query->row()->status;
			if($password==$this->input->post('password') && $status==1){
				return true;
			}
		}
		$this->form_validation->set_message('_login_check','Login failed!!!');
		return false;
	}
	function logout(){
		$this->session->unset_userdata('user_login');
		$this->session->unset_userdata('user_level');
		redirect('login');
	}
}
