<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Chaptermodel extends CI_Model{

	var $id		= 0;
	var $title	= '';
	var $note	= '';
	var $course	= 0;
	var $number = 0;
	var $test 	= 0;
	var $level 	= 0;

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->title 	= htmlspecialchars($data['title']);
		$this->note		= '';
		$this->course 	= $data['course'];
		$this->number 	= $data['number'];
		$this->test 	= 0;
		$this->level 	= $data['level'];
		
		$this->db->insert('chapter',$this);
		return $this->db->insert_id();
	}
	
	function active_test($id){
		
		$this->db->set('test',1);
		$this->db->where('id',$id);
		$this->db->update('chapter');
	}
	
	function deactive_test($id){
		
		$this->db->set('test',0);
		$this->db->where('id',$id);
		$this->db->update('chapter');
	}
	
	function update_record($data){
		
		$this->db->set('number',$data['number']);
		$this->db->set('title',htmlspecialchars($data['title']));
		$this->db->set('note','');
		$this->db->set('level',$data['level']);
		$this->db->where('id',$data['idchp']);
		
		$this->db->update('chapter');
		return $this->db->affected_rows();
	}
	
	function change_number($oldnumber,$number,$course){
		
		$this->db->set('number',$number);
		$this->db->where('course',$course);
		$this->db->where('number',$oldnumber);
		$this->db->update('chapter');
		return $this->db->affected_rows();
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('chapter',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($course){
		
		$this->db->where('course',$course);
		$this->db->order_by('number','ASC');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('chapter');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('chapter',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('chapter');
		return $this->db->affected_rows();
	}
	
	function count_records($course){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('course',$course);
		$query = $this->db->get('chapter');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function next_number($course){
		
		$this->db->select('MAX(number) as number');
		$this->db->where('course',$course);
		$query = $this->db->get('chapter');
		$data = $query->result_array();
		return $data[0]['number']+1;
	}
}