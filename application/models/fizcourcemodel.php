<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fizcourcemodel extends CI_Model{

    var $id   		= 0;
    var $course 	= '';
    var $physical   = '';
    var $order    	= '';
    var $status   	= 0;
    var $result   	= 0;
    var $dateover  	= '';
    var $start  	= 0;
    var $tresid  	= 0;
    var $idnumber  	= 0;

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($course,$physical,$order){
			
		$this->course	= $course;
		$this->physical = $physical;
		$this->order 	= $order;

		$this->db->insert('fizcourse',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('fizcourse',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('fizcourse');
		return $this->db->affected_rows();
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('fizcourse',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function active_orders($physical){
		
		$this->db->where('physical',$physical);
		$this->db->where('status',0);
		$query = $this->db->get('fizcourse');
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function read_status($id){
			
		$this->db->where('status',1);
		$query = $this->db->get('fizcourse',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('fizcourse');
		return $this->db->affected_rows();
	}
	
	function delete_records($course){
	
		$this->db->where('course',$course);
		$this->db->delete('fizcourse');
		return $this->db->affected_rows();
	}
	
	function delete_physical_records($physical){
	
		$this->db->where('physical',$physical);
		$this->db->delete('fizcourse');
		return $this->db->affected_rows();
	}
	
	function delete_order_records($order){
	
		$this->db->where('order',$order);
		$this->db->delete('fizcourse');
		return $this->db->affected_rows();
	}

	function count_course_record($course){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('course',$course);
		$query = $this->db->get('fizcourse');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function count_order_record($order){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('order',$order);
		$query = $this->db->get('fizcourse');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function count_physical_by_order($order){
		
		$query = "SELECT COUNT(id) AS cnt FROM fizcourse WHERE fizcourse.order = $order";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0]['cnt'];
		return NULL;
	}
	
	function read_record_by_order($order){
		
		$query = "SELECT id FROM fizcourse WHERE fizcourse.order = $order";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function max_idnumber(){
		
		$query = "SELECT MAX(idnumber*1) AS idnumber FROM fizcourse";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['idnumber'];
		return NULL;
	}
	
	function over_course($id,$status,$result){
		
		$this->db->set('status',$status);
		$this->db->set('result',$result);
		$this->db->set('dateover',date("Y-m-d"));
		$this->db->where('id',$id);
		$this->db->update('fizcourse');
		return $this->db->affected_rows();
	}
	
	function owner_acorder($id,$course,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fizcourse',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_audience($id,$physical,$status){
		
		$this->db->where('id',$id);
		$this->db->where('status',$status);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fizcourse',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function exist_course_physical($physical,$course,$order){
		
		$this->db->where('physical',$physical);
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$query = $this->db->get('fizcourse',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
}