<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Coursesmodel extends CI_Model{

    var $id   	= 0;
    var $title 	= '';
    var $note  	= '';
    var $price  = '';
    var $trend  = 0;
    var $view  	= 0;
    var $days  	= 0;
    var $code  	= '';

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->title 	= $data['title'];
		$this->note		= $data['note'];
		$this->price 	= $data['price'];
		$this->trend  	= $data['trend'];
		$this->view  	= 0;
		$this->days  	= $data['days'];
		$this->code  	= $data['code'];
		
		$this->db->insert('courses',$this);
		return $this->db->insert_id();
	}
	
	function active_status($id){
		
		$this->db->set('view',1);
		$this->db->where('id',$id);
		$this->db->update('courses');
	}
	
	function deactive_status($id){
		
		$this->db->set('view',0);
		$this->db->where('id',$id);
		$this->db->update('courses');
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('courses',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('courses',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('courses');
		return $this->db->affected_rows();
	}	
}