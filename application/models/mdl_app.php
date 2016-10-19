<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_app extends CI_Model {
	var $tbl_name = 'app';
	function query(){
		$data[] = $this->search();
		$data[] = $this->db->select('app.*,user.fullname,divisi.divisi_no,divisi.divisi,divisi.posisi_no,divisi.posisi');
		$data[] = $this->where('country','app.country');
		$data[] = $this->where('de','app.user_create');
		$data[] = $this->where_date('date','date_format(app.date_create,\'%Y-%m-%d\')');
		if($this->session->userdata('user_level')==3){
			$data[] = $this->db->where('date_format(app.date_create,\'%Y-%m-%d\')',date('Y-m-d'));
			$data[] = $this->db->where('app.user_create',$this->session->userdata('user_login'));
		}
		$data[] = $this->db->select('app.*,user.fullname');
		$data[] = $this->db->join('user','app.user_create=user.id','left');		
		$data[] = $this->db->join('divisi','app.dem_1=divisi.code','left');		
		return $data;
	}
	function get_last_code(){
		$this->db->where('user_create',$this->session->userdata('user_login'));
		$this->db->order_by('code','desc');
		$this->db->limit(1);
		$query = $this->db->get($this->tbl_name);
		if($query->num_rows()>0){
			$data = $query->row()->code+1;
		}else{
			$data = 1;
		}
		return $data;
	}
	function get(){
		$this->query();
		$this->order();
		$this->limit();
		return $this->db->get($this->tbl_name);
	}	
	function export(){
		$this->query();
		$this->order();
		return $this->db->get($this->tbl_name);
	}	
	function get_from_field($field,$val){
		$this->db->where($field,$val);
		return $this->db->get($this->tbl_name);	
	}
	function check_double($code,$country){
		$this->db->where('code',$code);
		$this->db->where('country',$country);
		return $this->db->get($this->tbl_name);	
	}
	function count_all(){
		$this->query();
		return $this->db->get($this->tbl_name)->num_rows();
	}
	function add($data){
		$this->db->insert($this->tbl_name,$data);
	}
	function edit($id,$data){
		$this->db->where('id',$id);
		$this->db->update($this->tbl_name,$data);
	}
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete($this->tbl_name);
	}
	function order(){
		$order_column = ($this->input->get('order_column')<>''?$this->input->get('order_column'):'id');
		$order_type = ($this->input->get('order_type')<>''?$this->input->get('order_type'):'desc');
		$data[] = $this->db->order_by($order_column,$order_type);
		return $data;
	}
	function limit(){
		$limit = ($this->input->get('limit')<>''?$this->input->get('limit'):'10');
		$offset = ($this->input->get('offset')<>''?$this->input->get('offset'):'0');
		return $this->db->limit($limit,$offset);
	}
	function search(){
		$value = $this->input->get('search');
		if($value <> ''){
			return $this->db->where('app.code',$value);
		}		
	}
	function where($id,$field=''){
		$value = $this->input->get($id);
		if($value <> ''){
			return $this->db->where(($field<>''?$field:$id),$value);
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
	function pi_dropdown(){
		$data[''] = '- Interviewer -';
		$this->db->where('level',3);
		$result = $this->db->get($this->tbl_name)->result();
		foreach($result as $r){
			$data[$r->id] = $r->fullname;
		}	
		return $data;
	}
}
