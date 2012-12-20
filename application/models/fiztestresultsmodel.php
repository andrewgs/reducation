<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fiztestresultsmodel extends CI_Model{

    var $id   			= 0;
    var $order 			= 0;
    var $course 		= 0;
    var $physical   	= 0;
    var $test	   		= 0;
    var $result			= 0;
    var $time			= 0;
    var $dataresult		= '';

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($course,$physical,$order,$test,$dataresult,$result){
			
		$this->order		= $order;
		$this->course		= $course;
		$this->physical 	= $physical;
		$this->result		= $result;
		$this->test			= $test;
		$this->dataresult 	= $dataresult;

		$this->db->insert('fiztestresults',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('fiztestresults',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($course,$order,$chapter,$physical){
		
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$this->db->where('chapter',$chapter);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fiztestresults',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('fiztestresults');
		return $this->db->affected_rows();
	}
	
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('fiztestresults',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('fiztestresults');
		return $this->db->affected_rows();
	}
	
	function delete_records($course){
	
		$this->db->where('course',$course);
		$this->db->delete('fiztestresults');
		return $this->db->affected_rows();
	}
	
	function delete_physical_records($physical){
	
		$this->db->where('physical',$physical);
		$this->db->delete('fiztestresults');
		return $this->db->affected_rows();
	}
	
	function delete_order_records($order){
	
		$this->db->where('order',$order);
		$this->db->delete('fiztestresults');
		return $this->db->affected_rows();
	}

	function count_course_record($course){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('course',$course);
		$query = $this->db->get('fiztestresults');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function count_order_record($order){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('order',$order);
		$query = $this->db->get('fiztestresults');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	
	function exist_report($physical,$course,$repid){
		
		$this->db->where('physical',$physical);
		$this->db->where('course',$course);
		$this->db->where('id',$repid);
		$query = $this->db->get('fiztestresults',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_report($course,$repid){
		
		$this->db->where('course',$course);
		$this->db->where('id',$repid);
		$query = $this->db->get('fiztestresults',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
}