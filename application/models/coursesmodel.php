<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Coursesmodel extends CI_Model{

    var $id   	= 0;
    var $title 	= '';
    var $note  	= '';
    var $price  = '';
    var $trend  = 0;
    var $view  	= 0;
    var $hours 	= 0;
    var $code  	= '';

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->title 	= $data['title'];
		$this->note		= '';
		$this->price 	= $data['price'];
		$this->trend  	= $data['trend'];
		$this->view  	= 0;
		$this->hours  	= $data['hours'];
		$this->code  	= $data['code'];
		
		$this->db->insert('courses',$this);
		return $this->db->insert_id();
	}
	
	function update_record($data){
			
		$this->db->set('code',$data['code']);
		$this->db->set('title',$data['title']);
		$this->db->set('price',$data['price']);
		$this->db->set('hours',$data['hours']);
		$this->db->set('note','');
		$this->db->set('view',$data['view']);
		$this->db->where('id',$data['icrs']);
		$this->db->update('courses');
		return $this->db->affected_rows();
	}
	
	function active_status($id){
		
		$this->db->set('view',1);
		$this->db->where('id',$id);
		$this->db->update('courses');
	}
	
	function deactive_status_trend($trend){
		
		$this->db->set('view',0);
		$this->db->where('trend',$trend);
		$this->db->update('courses');
	}
	
	function active_status_trend($trend){
		
		$this->db->set('view',1);
		$this->db->where('trend',$trend);
		$this->db->update('courses');
	}
	
	function deactive_status($id){
		
		$this->db->set('view',0);
		$this->db->where('id',$id);
		$this->db->update('courses');
	}
	
	function read_records(){
		
		$query = $this->db->get('courses');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
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