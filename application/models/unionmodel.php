<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Unionmodel extends CI_Model{

    function __construct(){
        parent::__construct();
    }
	
	function read_audience(){
		
		$query = "SELECT audience.*,customers.organization,customers.person FROM customers INNER JOIN audience ON customers.id=audience.customer ORDER BY audience.access DESC,audience.signupdate DESC, audience.id DESC";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_corder_records($order){
		
		$query = "SELECT courseorder.*,courses.title,courses.price,courses.code FROM courseorder INNER JOIN courses ON courseorder.course=courses.id WHERE courseorder.order = $order ORDER BY courseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_caudience_records($order){
		
		$query = "SELECT audienceorder.*,audience.lastname,audience.name,audience.middlename,audience.specialty FROM audienceorder INNER JOIN audience ON audienceorder.audience=audience.id WHERE audienceorder.order = $order ORDER BY audienceorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function audience_course($course){
		
		$query = "SELECT audienceorder.*,audience.lastname,audience.name,audience.middlename,audience.specialty FROM audienceorder INNER JOIN audience ON audienceorder.audience=audience.id WHERE audienceorder.course = $course ORDER BY audienceorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_courseorder_title($order){
		
		$query = "SELECT courses.code, courses.title FROM courseorder INNER JOIN courses ON courseorder.course=courses.id WHERE courseorder.order = $order ORDER BY courseorder.id";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}