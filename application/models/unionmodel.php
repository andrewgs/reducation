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

	function valid_empty_course($order){
		
		$query = "SELECT COUNT(audienceorder.id) AS cnt FROM courseorder LEFT JOIN audienceorder ON courseorder.id=audienceorder.course WHERE courseorder.order = $order GROUP BY courseorder.course";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function read_audience_currect_courses($audience,$status){
		
		$query = "SELECT courses.id,courses.title,courses.code,courses.trend,courses.hours,audienceorder.start,audienceorder.id AS aud FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}