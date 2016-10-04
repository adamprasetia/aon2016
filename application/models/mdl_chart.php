<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_chart extends CI_Model {
	function query(){
		$data = '';
		if($this->session->userdata('user_level')==3){
			$data[] = $this->db->where('app.user_create',$this->session->userdata('user_login'));
		}
		return $data;	
	}
	function pop_entry(){
		$this->query();
		$this->db->select(array('count(*) as jumlah','date_format(date_create,\'%Y-%m-%d\') as y'));
		$this->db->group_by(array('date_format(date_create,\'%Y-%m-%d\')'));
		$this->db->order_by('date_create','asc');
		return $this->db->get('app');
	}
	function pop_de(){
		$this->query();
		$this->db->select(array('count(*) as jumlah','user.fullname as de'));
		$this->db->join('user','app.user_create=user.id','left');
		$this->db->group_by('app.user_create');
		return $this->db->get('app');
	}
	function get_total_entry(){
		$this->query();
		return $this->db->count_all_results('app');	
	}
	function get_total_id(){
		$this->query();
		$this->db->where('country','ID');	
		return $this->db->count_all_results('app');	
	}
	function get_total_en(){
		$this->query();
		$this->db->where('country','EN');	
		return $this->db->count_all_results('app');	
	}
}
