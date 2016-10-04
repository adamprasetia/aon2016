<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mdl_chart');
	}
	function pop_entry(){
		$data = $this->mdl_chart->pop_entry()->result_array();
		echo json_encode($data);
	}
	function pop_de(){
		$data = $this->mdl_chart->pop_de()->result_array();
		echo json_encode($data);
	}
}