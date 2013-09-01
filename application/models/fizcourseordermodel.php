<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fizcourseordermodel extends CI_Model{

    var $id   		= 0;
    var $order 		= '';
    var $course  	= '';
    var $physical  	= '';
    var $price  	= '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($order,$course,$physical,$price){
			
		$this->order 		= $order;
		$this->course		= $course;
		$this->physical		= $physical;
		$this->price		= $price;
		
		$this->db->insert('fizcourseorder',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$order,$course,$physical,$price){
			
		$this->db->set('order',$order);
		$this->db->set('course',$course);
		$this->db->set('physical',$physical);
		$this->db->set('price',$price);
		$this->db->where('id',$id);
		$this->db->update('fizcourseorder');
		return $this->db->affected_rows();
	}
	
	function read_records(){
		
		$query = $this->db->get('fizcourseorder');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_order_records($order){
		
		$this->db->where('order',$order);
		$query = $this->db->get('fizcourseorder');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('fizcourseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('fizcourseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('fizcourseorder');
		return $this->db->affected_rows();
	}
	
	function delete_order($order){
	
		$this->db->where('order',$order);
		$this->db->delete('fizcourseorder');
		return $this->db->affected_rows();
	}

	function delete_physical_records($physical){
	
		$this->db->where('physical',$physical);
		$this->db->delete('fizcourseorder');
		return $this->db->affected_rows();
	}
	
	function owner_corder($id,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fizcourseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}

	function exist_course_order($course,$order,$physical){
		
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fizcourseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}

	function count_order_record($order){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('order',$order);
		$query = $this->db->get('fizcourseorder');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
}