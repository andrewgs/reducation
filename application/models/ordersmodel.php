<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Adminsmodel extends CI_Model {

    var $id   		= 0;
    var $company 	= '';
    var $orderdate  = '';
    var $price  	= '';
    var $status    	= '';

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($data){
			
		$this->company 	= $data['login'];
		$this->orderdate= $insertdata['orderdate'];
		$this->price 	= $data['price'];
		$this->status 	= 0;
		
		$this->db->insert('admins',$this);
		return $this->db->insert_id();
	}
	
	function active_status($id){
		
		$this->db->set('status',1);
		$this->db->where('id',$id);
		$this->db->update('admins');
	}
	
	function deactive_status($id){
		
		$this->db->set('status',0);
		$this->db->where('id',$id);
		$this->db->update('admins');
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('admins',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('admins',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('admins');
		return $this->db->affected_rows();
	}	
}