<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_vendor extends CI_Model {
	var $tbl_name = 'vendor';
	function __construct(){
		parent::__construct();
	}
	function dropdown(){
		$data[''] = '- Vendor -';
		$this->db->order_by('name','asc');
		$result = $this->db->get($this->tbl_name)->result();
		foreach($result as $r){
			$data[$r->id] = $r->name;
		}	
		return $data;
	}
}
