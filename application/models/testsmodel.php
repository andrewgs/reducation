<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Testsmodel extends CI_Model{

	var $id   		= 0;
	var $number		= 0;
	var $title 		= '';
	var $note  		= '';
	var $count 		= 5;
	var $timetest 	= '';
	var $chapter 	= 0;
	var $course 	= 0;
	var $view 		= 1;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->number 	= $data['number'];
		$this->title 	= htmlspecialchars($data['title']);
		$this->note		= '';
		$this->count	= $data['count'];
		$this->timetest	= $data['time'];
		$this->chapter	= $data['chapter'];
		$this->course 	= $data['course'];
		$this->view 	= 1;
		
		$this->db->insert('tests',$this);
		return $this->db->insert_id();
	}
	
	function active_status($id){
		
		$this->db->set('view',1);
		$this->db->where('id',$id);
		$this->db->update('tests');
	}
	
	function deactive_status($id){
		
		$this->db->set('view',0);
		$this->db->where('id',$id);
		$this->db->update('tests');
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('tests',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function update_record($data){
	
		$this->db->set('number',$data['number']);
		$this->db->set('title',htmlspecialchars($data['title']));
		$this->db->set('note','');
		$this->db->set('count',$data['count']);
		$this->db->set('timetest',$data['time']);
		$this->db->set('view',1);
		$this->db->where('id',$data['idt']);
		
		$this->db->update('tests');
		return $this->db->affected_rows();
	}
	
	function read_record_chapter($chapter){
		
		$this->db->where('chapter',$chapter);
		$query = $this->db->get('tests',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_record_course($course){
		
		$this->db->where('course',$course);
		$query = $this->db->get('tests',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function exit_course_final($course){
		
		$this->db->where('course',$course);
		$this->db->where('chapter',0);
		$query = $this->db->get('tests');
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('tests',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('tests');
		return $this->db->affected_rows();
	}

	function count_course_record($course){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('course',$course);
		$this->db->where('chapter >',0);
		$query = $this->db->get('tests');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
}