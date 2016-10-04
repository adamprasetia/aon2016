<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_fee extends CI_Model {
	var $tbl_name = 'app';
	function query(){
		$data[] = $this->db->select('fullname,count(*) as jumlah');
		$data[] = $this->db->join('user','app.user_create=user.id','left');
		$data[] = $this->db->group_by('app.user_create');
		$data[] = $this->db->where('salah <>','Y');
		$data[] = $this->where_date('date','date_format(app.date_create,\'%Y-%m-%d\')');
		return $data;
	}
	function get(){
		$this->query();
		return $this->db->get($this->tbl_name);
	}	
	function count_all(){
		$this->query();
		return $this->db->get($this->tbl_name)->num_rows();
	}
	function where($id){
		$value = $this->input->get($id);
		if($value <> ''){
			return $this->db->where($id,$value);
		}		
	}
	function like($id){
		$value = $this->input->get($id);
		if($value <> ''){
			return $this->db->like($id,$value);
		}		
	}	
	function where_date($id,$field){
		$from = $this->input->get($id.'_from');
		$to = $this->input->get($id.'_to');
		$data = '';
		if($from <> '' && $to <> ''){
			$data[] = $this->db->where($field.' >=',format_tanggal_barat($from));
			$data[] = $this->db->where($field.' <=',format_tanggal_barat($to));
		}		
		return $data;
	}	
}
