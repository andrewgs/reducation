<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Audiencetestmodel extends CI_Model{

	var $id   			= 0;
	var $order 			= 0;
	var $course 		= 0;
	var $audience   	= 0;
	var $chapter   		= 0;
	var $test	   		= 0;
	var $attempt		= 0;
	var $result			= 0;
	var $time			= 0;
	var $attemptnext	= '';
	var $attemptdate	= '';
	var $customer		= 0;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($course,$audience,$order,$customer,$chapter,$test){
			
		$this->order	= $order;
		$this->course	= $course;
		$this->audience = $audience;
		$this->customer	= $customer;
		$this->chapter	= $chapter;
		$this->test		= $test;

		$this->db->insert('audiencetest',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_exam_test_info($order,$course,$audience){
		
		$this->db->select('test,attempt,result,time');
		$this->db->where('order',$order);
		$this->db->where('course',$course);
		$this->db->where('audience',$audience);
		$this->db->where('chapter',0);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($course,$order,$chapter,$audience){
		
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$this->db->where('chapter',$chapter);
		$this->db->where('audience',$audience);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if($data) return $data[0];
		return NULL;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('audiencetest');
		return $this->db->affected_rows();
	}
	
	function reset_attempt($id){
			
		$this->db->set('attempt',0);
		$this->db->set('result',0);
		$this->db->set('time',0);
		$this->db->set('attemptnext','0000-00-00');
		$this->db->set('attemptdate','0000-00-00');
		$this->db->where('id',$id);
		$this->db->update('audiencetest');
		return $this->db->affected_rows();
	}
	
	function update_result($id,$result,$time){
			
		$this->db->set('result',$result);
		$this->db->set('time',$time);
		$this->db->set('attempt','attempt+1',FALSE);
		$this->db->set('attemptdate',date("Y-m-d"));
		$this->db->where('id',$id);
		$this->db->update('audiencetest');
		return $this->db->affected_rows();
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('audiencetest');
		return $this->db->affected_rows();
	}
	
	function delete_records($course){
	
		$this->db->where('course',$course);
		$this->db->delete('audiencetest');
		return $this->db->affected_rows();
	}
	
	function delete_customer_records($customer){
	
		$this->db->where('customer',$customer);
		$this->db->delete('audiencetest');
		return $this->db->affected_rows();
	}
	
	function delete_order_records($order){
	
		$this->db->where('order',$order);
		$this->db->delete('audiencetest');
		return $this->db->affected_rows();
	}

	function count_course_record($course){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('course',$course);
		$query = $this->db->get('audiencetest');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function count_order_record($order){
	
		$this->db->select('COUNT(*) AS cnt');
		$this->db->where('order',$order);
		$query = $this->db->get('audiencetest');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return NULL;
	}
	
	function owner_acorder($id,$course,$customer){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('customer',$customer);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_testing($id,$course,$audience){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('audience',$audience);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_final_testing($id,$course,$audience){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('audience',$audience);
		$this->db->where('chapter',0);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_nonfinal_testing($id,$course,$audience){
		
		$this->db->where('id',$id);
		$this->db->where('course',$course);
		$this->db->where('audience',$audience);
		$this->db->where('chapter >',0);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function exist_course_audience($audience,$course,$order,$customer){
		
		$this->db->where('audience',$audience);
		$this->db->where('course',$course);
		$this->db->where('order',$order);
		$this->db->where('customer',$customer);
		$query = $this->db->get('audiencetest',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function open_tests($chapter){
		
		$query = "SELECT audiencetest.id,audiencetest.course FROM audiencetest WHERE audiencetest.chapter = $chapter AND audiencetest.order IN (SELECT orders.id FROM orders WHERE orders.paid = 1 AND orders.numbercompletion = '')";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return FALSE;
	}
	
	function open_orders_final_tests($test){
		
		$query = "SELECT audiencetest.id FROM audiencetest WHERE audiencetest.test = $test AND audiencetest.order IN (SELECT orders.id FROM orders WHERE orders.paid = 1 AND orders.numbercompletion = '')";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return FALSE;
	}
}