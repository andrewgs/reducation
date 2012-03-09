<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Testanswersmodel extends CI_Model{

	var $id   			= 0;
	var $number			= 0;
	var $title 			= '';
	var $note  			= '';
	var $correct		= 0;
	var $test	 		= 0;
	var $testquestion 	= 0;
	var $chapter 		= 0;
	var $course 		= 0;
	var $view 			= 1;

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->number 		= $data['number'];
		$this->title 		= htmlspecialchars($data['title']);
		$this->note			= '';
		$this->correct		= $data['correct'];
		$this->test			= $data['test'];
		$this->testquestion	= $data['idqes'];
		$this->chapter		= $data['chapter'];
		$this->course 		= $data['course'];
		$this->view 		= 1;
		
		$this->db->insert('testanswers',$this);
		return $this->db->insert_id();
	}
	
	function insert_ajax_record($number,$title,$test,$chapter,$course,$correct,$idqes){
			
		$this->number 		= $number;
		$this->title 		= htmlspecialchars($title);
		$this->note			= '';
		$this->correct		= $correct;
		$this->test			= $test;
		$this->testquestion	= $idqes;
		$this->chapter		= $chapter;
		$this->course 		= $course;
		$this->view 		= 1;
		
		$this->db->insert('testanswers',$this);
		return $this->db->insert_id();
	}
	
	function active_status($id){
		
		$this->db->set('view',1);
		$this->db->where('id',$id);
		$this->db->update('testanswers');
	}
	
	function deactive_status($id){
		
		$this->db->set('view',0);
		$this->db->where('id',$id);
		$this->db->update('testanswers');
	}
	
	function read_records($test){
		
		$this->db->where('test',$test);
		$this->db->order_by('number','ASC');
		$this->db->order_by('id','ASC');
		$query = $this->db->get('testanswers');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_correct_answers($test){
		
		$this->db->select('id,testquestion AS numb');
		$this->db->where('correct',1);
		$this->db->where('test',$test);
		$this->db->order_by('id','ASC');
		$query = $this->db->get('testanswers');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('testanswers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('testanswers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function update_record($data){
		
		$this->db->set('number',$data['number']);
		$this->db->set('title',htmlspecialchars($data['title']));
		$this->db->set('note','');
		$this->db->set('correct',$data['correct']);
		$this->db->set('view',1);
		$this->db->where('id',$data['idans']);
		
		$this->db->update('testanswers');
		return $this->db->affected_rows();
	}
	
	function change_number($oldnumber,$number,$testquestion){
		
		$this->db->set('number',$number);
		$this->db->where('testquestion',$testquestion);
		$this->db->where('number',$oldnumber);
		$this->db->update('testanswers');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('testanswers');
		return $this->db->affected_rows();
	}
								  
	function delete_records_course($course){
	
		$this->db->where('course',$course);
		$this->db->delete('testanswers');
		return $this->db->affected_rows();
	}

	function delete_records_question($question){
	
		$this->db->where('testquestion',$question);
		$this->db->delete('testanswers');
		return $this->db->affected_rows();
	}

	function next_number($testquestion){
		
		$this->db->select('MAX(number) as number');
		$this->db->where('testquestion',$testquestion);
		$query = $this->db->get('testanswers');
		$data = $query->result_array();
		return $data[0]['number']+1;
	}
}