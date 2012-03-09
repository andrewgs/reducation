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

	function read_audience_courses($audience,$status){
		
		$query = "SELECT courses.id,courses.title,courses.code,courses.trend,courses.hours,audienceorder.start,audienceorder.id AS aud,audienceorder.order FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_audience_currect_course($audience,$course,$status){
		
		$query = "SELECT audienceorder.order AS ordid, courses.id,courses.title,courses.code,courses.trend,courses.hours,audienceorder.start,audienceorder.course FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.id = $course AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}
	
	function read_course_libraries($audience,$course,$status){
		
		$query = "SELECT courses.libraries FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.id = $course AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0]['libraries'];
		return NULL;
	}
	
	function read_course_curriculum($audience,$course,$status){
		
		$query = "SELECT courses.curriculum FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN audienceorder ON audienceorder.course = courseorder.id INNER JOIN orders ON courseorder.order=orders.id WHERE audienceorder.audience = $audience AND audienceorder.id = $course AND audienceorder.status = $status AND orders.paid = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0]['curriculum'];
		return NULL;
	}
	
	function get_courses_test($audorder,$audience,$status){
		
		$query = "SELECT tests.*, courseorder.id AS coid,audienceorder.id AS aoid,courseorder.order AS ordid,courseorder.customer AS ordcus FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN tests ON courses.id = tests.course INNER JOIN audienceorder ON courseorder.id = audienceorder.course WHERE audienceorder.id = $audorder AND audienceorder.audience = $audience AND audienceorder.status = $status AND tests.chapter > 0 AND audienceorder.start = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)>0) return $data;
		return NULL;
	}
	
	function get_courses_examination($audorder,$audience,$status){
		
		$query = "SELECT tests.*, courseorder.id AS coid,audienceorder.id AS aoid,courseorder.order AS ordid,courseorder.customer AS ordcus FROM courseorder INNER JOIN courses ON courses.id=courseorder.course INNER JOIN tests ON courses.id = tests.course INNER JOIN audienceorder ON courseorder.id = audienceorder.course WHERE audienceorder.id = $audorder AND audienceorder.audience = $audience AND audienceorder.status = $status AND tests.chapter = 0 AND audienceorder.start = 1";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}

	function read_audience_testing($id,$audience,$course){
		
		$query = "SELECT tests.id AS tid,tests.title AS ttitle,tests.count AS tcount,tests.timetest AS ttime, audiencetest.* FROM audiencetest INNER JOIN tests ON audiencetest.test = tests.id WHERE audiencetest.audience = $audience AND audiencetest.id = $id AND audiencetest.course = $course";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(isset($data)) return $data[0];
		return NULL;
	}
}