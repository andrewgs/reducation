<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Audienceordermodel extends CI_Model{

    var $id   		= 0;
    var $course 	= '';
    var $audience   = '';
    var $order    	= '';
    var $customer   = '';
    var $status   	= 0;
    var $result   	= 0;
    var $dateover  	= '';
    var $start  	= 0;
    var $tresid  	= 0;
    var $idnumber  	= 0;

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($course,$audience,$order,$customer){
			
		$this->course	= $course;
		$this->audience = $audience;
		$this->order 	= $order;
		$this->customer	= $customer;
		$this->status	= 0;
		$this->result	= 0;
		$this->dateover	= '';

		$this->db->insert('audienceorder',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('audienceorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('audienceorder');
		return $this->db->affected_rows();
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('audienceorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function active_orders($audience){
		
		$this->db->where('audience',$audience);
		$this->db->where('status',0);
		$query = $this->db->get('audienceorder');
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function read_status($id){
			
		$this->db->where('status',1);
		$query = $this->db->get('audienceorder',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('audienceorder');
		return $this->db->affected_rows();
	}
	
	function delete_records($course){
	
		$this->db->where('course',$course);
		$this->db->delete('audienceorder');
		return $this->db->affected_rows();
	}
	
	function delete_customer_records($customer){
	
		$this->db->where('customer',$customer);
		$this->db->delete('audienceorder');
		return $this->db->affected_rows();
	}
	
	function delete_order_records($order){
	
		$this->db->where('order',$order);
		$this->db->delete('audienceorder');
		return $this->db->affected_rows();
	}

	function count_course_record($course){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('course',$course);
		$query = $this->db->get('audienceorder');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function count_order_record($order){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('order',$order);
		$query = $this->db->get('audienceorder');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function count_audience_by_order($order){
		
		$query = "SELECT COUNT(id) AS cnt FROM audienceorder WHERE audienceorder.order = $order";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0]['cnt'];
		return NULL;
	}
	
	function read_record_by_order($order){
		
		$query = "SELECT id FROM audienceorder WHERE audienceorder.order = $order";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function max_idnumber(){
		
		$query = "SELECT MAX(idnumber*1) AS idnumber FROM audienceorder";
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
		$this->db->update('audienceorder');
		return $this->db->affected_rows();
	}
	
	function owner_acorder($id,$course,$customer){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('customer',$customer);
		$query = $this->db->get('audienceorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_audience($id,$audience,$status){
		
		$this->db->where('id',$id);
		$this->db->where('status',$status);
		$this->db->where('audience',$audience);
		$query = $this->db->get('audienceorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function exist_course_audience($audience,$course,$order,$customer){
		
		$this->db->where('audience',$audience);
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$this->db->where('customer',$customer);
		$query = $this->db->get('audienceorder',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
}