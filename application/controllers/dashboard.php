<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_app');
		$this->load->model('mdl_chart');
	}
	function index(){
		$data['title'] = APP_NAME.' - Dashboard';
		$data['total'] = number_format($this->mdl_chart->get_total_entry());
		$data['total_id'] = number_format($this->mdl_chart->get_total_id());
		$data['total_en'] = number_format($this->mdl_chart->get_total_en());
		$data['de'] = number_format($this->_get_de());
		$this->lib_general->display('dashboard',$data);
	}
	function _get_de(){
		return $this->mdl_user->get_from_field('level','3')->num_rows();	
	}
}