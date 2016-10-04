<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_general {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
		$this->ci->load->model('mdl_user');
	}
	function display($view,$data=null){
		$data['username'] = $this->get_username($this->ci->session->userdata('user_login'));
		$data['content'] = $this->ci->load->view($view,$data,true);
		$data['menu'] = $this->get_menu();
		$this->ci->load->view('template',$data);
	}
	function get_username($id){
		$row = $this->ci->mdl_user->get_from_field('id',$id);
		if($row->num_rows()>0){
			return $row->row()->fullname;
		}
	}
	function get_menu(){
		$level = $this->ci->session->userdata('user_level');
		$menu = menu($level);
		$data = '';
		foreach($menu as $r => $val){
			$data .= '<li>'.anchor($r,$val).'</li>';
		}
		return $data;
	}	
	function order_type($field){
		$order_column = $this->ci->input->get('order_column');
		$order_type = $this->ci->input->get('order_type');
		if($order_type=='asc' && $order_column==$field){
			return 'desc';	
		}else{
			return 'asc';
		}
	}
	function order_icon($field){
		$order_column = $this->ci->input->get('order_column');
		$order_type = $this->ci->input->get('order_type');
		if($order_column==$field){
			switch($order_type){
				case 'asc':return '<span class="glyphicon glyphicon-chevron-up"></span>';break;
				case 'desc':return '<span class="glyphicon glyphicon-chevron-down"></span>';break;
				default:return "";break;
			}	
		}		
	}	
	function value_get($id,$false){
		$data = $this->ci->input->get($id);
		if($data <> ''){
			return $data;	
		}
		return $false;
	}
}