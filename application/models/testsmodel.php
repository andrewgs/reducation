<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Testsmodel extends CI_Model{

    var $id   		= 0;
    var $number		= 0;
    var $title 		= '';
    var $note  		= '';
    var $count 		= 5;
    var $timetest 	= '';
    var $chapter 	= 0;
    var $courses 	= 0;
    var $view 		= 0;

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->number 	= $data['number'];
		$this->title 	= $data['title'];
		$this->note		= $data['note'];
		$this->count	= $data['count'];
		$this->timetest	= $data['timetest'];
		$this->chapter	= $data['chapter'];
		$this->course 	= $data['course'];
		$this->view 	= 0;
		
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
}