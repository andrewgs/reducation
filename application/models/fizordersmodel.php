<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fizordersmodel extends CI_Model{

	var $id   				= 0;
	var $trend 				= 0;
	var $physical 			= '';
	var $orderdate  		= '0000-00-00';
	var $price  			= 0;
	var $finish				= 0;
	var $paid				= 0;
	var $paiddate			= '0000-00-00';
	var $userpaiddate		= '0000-00-00';
	var $closedate			= '0000-00-00';
	var $numberplacement	= '';
	var $numbercompletion	= '';
	var $deleted			= 0;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($trend,$physical){
		
		$this->trend	= $trend;
		$this->physical	= $physical;
		$this->orderdate= date("Y-m-d");
		
		$this->db->insert('fizorders',$this);
		return $this->db->insert_id();
	}
	
	function count_orders($physical){
		
		$this->db->select('*');
		$this->db->where('physical',$physical);
		$query = $this->db->get('fizorders');
		$data = $query->result_array();
		return count($data);
	}
	
	function read_record($id){
		
		$this->db->where('id',$id);
		$query = $this->db->get('fizorders',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records(){
		
		$this->db->order_by('orderdate','DESC');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('fizorders');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function update_field($id,$field,$data){
			
		$this->db->set($field,$data);
		$this->db->where('id',$id);
		$this->db->update('fizorders');
		return $this->db->affected_rows();
	}
	
	function read_active_fizorders(){
		
		$this->db->order_by('orderdate','DESC');
		$this->db->order_by('id','DESC');
		$this->db->where('paid','0');
		$query = $this->db->get('fizorders');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_deactive_fizorders(){
		
		$this->db->order_by('orderdate','DESC');
		$this->db->order_by('id','DESC');
		$this->db->where('paid','1');
		$query = $this->db->get('fizorders');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_physical_record($physical){
		
		$this->db->order_by('orderdate','DESC');
		$this->db->order_by('id','DESC');
		$this->db->where('deleted',0);
		$this->db->where('physical',$physical);
		$query = $this->db->get('fizorders');
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('id',$id);
		$query = $this->db->get('fizorders',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function delete_record($id){
	
		$this->db->where('id',$id);
		$this->db->delete('fizorders');
		return $this->db->affected_rows();
	}
	
	function delete_physical_records($physical){
	
		$this->db->where('physical',$physical);
		$this->db->delete('fizorders');
		return $this->db->affected_rows();
	}
	
	function add_price($order,$price){
		
		$this->db->set('price','price+'.$price,FALSE);
		$this->db->where('id',$order);
		$this->db->update('fizorders');
		return $this->db->affected_rows();
	}
	
	function sub_price($order,$price){
		
		$this->db->set('price','price-'.$price,FALSE);
		$this->db->where('id',$order);
		$this->db->update('fizorders');
		return $this->db->affected_rows();
	}

	function close_order($id){
		
		$this->db->set('finish',1);
		$this->db->where('id',$id);
		$this->db->update('fizorders');
		return $this->db->affected_rows();
	}
	
	function owner_order_nonfinish($id,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('physical',$physical);
		$this->db->where('finish',0);
		$query = $this->db->get('fizorders',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function owner_order_finish($id,$physical){
		
		$this->db->where('id',$id);
		$this->db->where('physical',$physical);
		$this->db->where('finish',1);
		$query = $this->db->get('fizorders',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function paid_order($id,$status){
		
		$this->db->set('paid',$status);
		if(!$status):
			$date = '0000-00-00';
			$userdate = 'Не оплачен';
		else:
			$date = date("Y-m-d");
			$userdate = date("d.m.Y");
		endif;
		$this->db->set('paiddate',$date);
		$this->db->set('userpaiddate',$userdate);
		$this->db->where('id',$id);
		$this->db->update('fizorders');
		return $this->db->affected_rows();
	}

	function next_numbers(){
		
		$query = "SELECT MAX(numbercompletion*1)+1 AS completion, MAX(numberplacement*1)+1 AS placement FROM fizorders";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function last_id(){
		
		$query = "SELECT id FROM fizorders ORDER BY ID DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['id'];
		return NULL;
	}
	
	function set_autoincrement($value){
		
		$query = "ALTER TABLE `fizorders` AUTO_INCREMENT = $value";
		$query = $this->db->query($query);
	}
	
	function valid_finish($order){
		
		$this->db->where('id',$order);
		$this->db->where('finish',1);
		$query = $this->db->get('fizorders',1);
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
}