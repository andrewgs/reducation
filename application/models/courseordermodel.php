<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Courseordermodel extends CI_Model{

    var $id   		= 0;
    var $order 		= '';
    var $course  	= '';
    var $customer  	= '';

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($order,$course,$customer){
			
		$this->order 		= $order;
		$this->course		= $course;
		$this->customer		= $customer;
		
		$this->db->insert('courseorder',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$order,$course,$customer){
			
		$this->db->set('order',$order);
		$this->db->set('course',$course);
		$this->db->set('customer',$customer);
		$this->db->where('id',$id);
		$this->db->update('courseorder');
		return $this->db->affected_rows();
	}
	
	function read_records(){
		
		$query = $this->db->get('courseorder');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_order_records($order){
		
		$this->db->where('order',$order);
		$query = $this->db->get('courseorder');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('courseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('courseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('courseorder');
		return $this->db->affected_rows();
	}
	
	function delete_order($order){
	
		$this->db->where('order',$order);
		$this->db->delete('courseorder');
		return $this->db->affected_rows();
	}

	function delete_customer_records($customer){
	
		$this->db->where('customer',$customer);
		$this->db->delete('courseorder');
		return $this->db->affected_rows();
	}
	
	function owner_corder($id,$customer){
		
		$this->db->where('id',$id);
		$this->db->where('customer',$customer);
		$query = $this->db->get('courseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}

	function exist_course_order($course,$order,$customer){
		
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$this->db->where('customer',$customer);
		$query = $this->db->get('courseorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
}