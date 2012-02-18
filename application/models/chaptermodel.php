<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Chaptermodel extends CI_Model{

    var $id   	= 0;
    var $title 	= '';
    var $note  	= '';
    var $course = 0;
    var $number = 0;

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->title 	= $data['title'];
		$this->note		= '';
		$this->course 	= $data['course'];
		$this->number 	= $data['number'];
		
		$this->db->insert('chapter',$this);
		return $this->db->insert_id();
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
}