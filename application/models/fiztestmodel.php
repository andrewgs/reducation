<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fiztestmodel extends CI_Model{

	var $id   			= 0;
	var $order 			= 0;
	var $course 		= 0;
	var $physical   	= 0;
	var $chapter   		= 0;
	var $test	   		= 0;
	var $attempt		= 0;
	var $result			= 0;
	var $time			= 0;
	var $attemptnext	= '';
	var $attemptdate	= '';
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($course,$physical,$order,$chapter,$test){
			
		$this->order	= $order;
		$this->course	= $course;
		$this->physical = $physical;
		$this->chapter	= $chapter;
		$this->test		= $test;

		$this->db->insert('fiztest',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_exam_test_info($order,$course,$physical){
		
		$this->db->select('test,attempt,result,time');
		$this->db->where('order',$order);
		$this->db->where('course',$course);
		$this->db->where('physical',$physical);
		$this->db->where('chapter',0);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($course,$order,$chapter,$physical){
		
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$this->db->where('chapter',$chapter);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('fiztest');
		return $this->db->affected_rows();
	}
	
	function reset_attempt($id){
			
		$this->db->set('attempt',0);
		$this->db->set('result',0);
		$this->db->set('time',0);
		$this->db->set('attemptnext','0000-00-00');
		$this->db->set('attemptdate','0000-00-00');
		$this->db->where('id',$id);
		$this->db->update('fiztest');
		return $this->db->affected_rows();
	}
	
	function update_result($id,$result,$time){
			
		$this->db->set('result',$result);
		$this->db->set('time',$time);
		$this->db->set('attempt','attempt+1',FALSE);
		$this->db->set('attemptdate',date("Y-m-d"));
		$this->db->where('id',$id);
		$this->db->update('fiztest');
		return $this->db->affected_rows();
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('fiztest');
		return $this->db->affected_rows();
	}
	
	function delete_records($course){
	
		$this->db->where('course',$course);
		$this->db->delete('fiztest');
		return $this->db->affected_rows();
	}
	
	function delete_physical_records($physical){
	
		$this->db->where('physical',$physical);
		$this->db->delete('fiztest');
		return $this->db->affected_rows();
	}
	
	function delete_order_records($order){
	
		$this->db->where('order',$order);
		$this->db->delete('fiztest');
		return $this->db->affected_rows();
	}

	function count_course_record($course){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('course',$course);
		$query = $this->db->get('fiztest');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function count_order_record($order){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('order',$order);
		$query = $this->db->get('fiztest');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function owner_acorder($id,$course,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_testing($id,$course,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_final_testing($id,$course,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('physical',$physical);
		$this->db->where('chapter',0);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_nonfinal_testing($id,$course,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('physical',$physical);
		$this->db->where('chapter >',0);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function exist_course_audience($physical,$course,$order){
		
		$this->db->where('physical',$physical);
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$query = $this->db->get('fiztest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function open_tests($chapter){
		
		$query = "SELECT fiztest.id FROM fiztest WHERE fiztest.chapter = $chapter AND fiztest.order IN (SELECT orders.id FROM orders WHERE orders.paid = 1 AND orders.numbercompletion = '')";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return FALSE;
	}
	
}