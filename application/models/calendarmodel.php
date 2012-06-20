<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Calendarmodel extends CI_Model{

    var $id   = 0;
    var $date = '';

    function __construct(){
        parent::__construct();
    }
	
	function insert_record($date){
			
		$this->date = $date;
		
		$this->db->insert('calendar',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$date){
			
		$this->db->set('date',$date);
		$this->db->where('id',$id);
		$this->db->update('calendar');
		return $this->db->affected_rows();
	}
	
	function read_records(){
		
		$this->db->order_by('date');
		$query = $this->db->get('calendar');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_date(){
		
		$this->db->select('date');
		$this->db->order_by('date');
		$query = $this->db->get('calendar');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('calendar',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('calendar',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('calendar');
		return $this->db->affected_rows();
	}
	
	function exist_date($date){
		
		$this->db->where('date',$date);
		$query = $this->db->get('calendar',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}