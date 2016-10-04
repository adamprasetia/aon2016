<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_batch extends CI_Model {
	var $tbl_name = 'batch';
	function __construct(){
		parent::__construct();
	}
	function dropdown(){
		$data[''] = '';
		$this->db->order_by('origin','asc');
		$result = $this->db->get($this->tbl_name)->result();
		foreach($result as $r){
			$data[$r->id] = $r->origin.' - '.$r->code.' - '.$r->qty;
		}	
		return $data;
	}
}
