<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Trendsmodel extends CI_Model{

    var $id   		= 0;
    var $code 		= '';
    var $title 		= '';
    var $note  		= '';
    var $courses  	= 0;
    var $view  		= 0;

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->code 	= $data['code'];
		$this->title 	= $data['title'];
		$this->note		= '';
		$this->courses 	= 0;
		$this->view 	= $data['view'];
		
		$this->db->insert('trends',$this);
		return $this->db->insert_id();
	}
	
	function active_status($id){
		
		$this->db->set('view',1);
		$this->db->where('id',$id);
		$this->db->update('trends');
	}
	
	function deactive_status($id){
		
		$this->db->set('view',0);
		$this->db->where('id',$id);
		$this->db->update('trends');
	}
	
	function read_records(){
		
		$query = $this->db->get('trends');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('trends',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('trends',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('trends');
		return $this->db->affected_rows();
	}
	
	function insert_course($id){
	
		$this->db->set('courses','courses+1',FALSE);
		$this->db->where('id',$id);
		$this->db->update('trends');
	}
	
	function delete_courses($id){
	
		$this->db->set('courses','courses-1',FALSE);
		$this->db->where('id',$id);
		$this->db->update('trends');
	}
}