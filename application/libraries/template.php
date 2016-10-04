<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
		$this->ci->load->model('mdl_user');
		$this->ci->load->helper('security_helper');
	}
	function display($view,$data=null){
		$data['username'] = $this->get_username();
		$data['content'] = $this->ci->load->view($view,$data,true);
		$data['menu'] = $this->get_menu();
		$this->ci->load->view('template',$data);
	}
	function get_username(){
		$row = $this->ci->mdl_user->get_from_field('id',$this->ci->session->userdata('user_login'));
		if($row->num_rows()>0){
			return $row->row()->fullname;
		}
	}
	function get_menu(){
		$level = $this->ci->session->userdata('user_level');
		$menu = menu($level);
		$data = '';
		foreach($menu as $r => $val){
			$data .= '<li class="'.($this->ci->uri->segment(1)==$r?'active':"").'">'.anchor($r,$val).'</li>';
		}
		return $data;
	}
}