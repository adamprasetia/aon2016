<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_divisi extends CI_Model {
	var $tbl_name = 'divisi';
	function __construct(){
		parent::__construct();
	}
	function dropdown($country){
		$data[''] = '';
		$this->db->where('country',$country);
		$result = $this->db->get($this->tbl_name)->result();
		foreach($result as $r){
			$data[$r->code] = $r->divisi.' - '.$r->posisi;
		}	
		return $data;
	}
}
