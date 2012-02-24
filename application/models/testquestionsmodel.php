<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Testquestionsmodel extends CI_Model{

    var $id   		= 0;
    var $number		= 0;
    var $title 		= '';
    var $note  		= '';
    var $test	 	= 0;
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
		$this->test		= $data['test'];
		$this->chapter	= $data['chapter'];
		$this->course 	= $data['course'];
		$this->view 	= 1;
		
		$this->db->insert('testquestions',$this);
		return $this->db->insert_id();
	}
	
	function insert_ajax_record($number,$title,$test,$chapter,$course){
			
		$this->number 	= $number;
		$this->title 	= htmlspecialchars($title);
		$this->note		= '';
		$this->test		= $test;
		$this->chapter	= $chapter;
		$this->course 	= $course;
		$this->view 	= 1;
		
		$this->db->insert('testquestions',$this);
		return $this->db->insert_id();
	}
	
	function active_status($id){
		
		$this->db->set('view',1);
		$this->db->where('id',$id);
		$this->db->update('testquestions');
	}
	
	function deactive_status($id){
		
		$this->db->set('view',0);
		$this->db->where('id',$id);
		$this->db->update('testquestions');
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('testquestions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($test){
		
		$this->db->where('test',$test);
		$this->db->order_by('number','ASC');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('testquestions');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function update_record($data){
	
		$this->db->set('number',$data['number']);
		$this->db->set('title',htmlspecialchars($data['title']));
		$this->db->set('note','');
		$this->db->set('view',1);
		$this->db->where('id',$data['idqes']);
		
		$this->db->update('testquestions');
		return $this->db->affected_rows();
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('testquestions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('testquestions');
		return $this->db->affected_rows();
	}

	function delete_records_course($course){
	
		$this->db->where('course',$course);
		$this->db->delete('testquestions');
		return $this->db->affected_rows();
	}
}