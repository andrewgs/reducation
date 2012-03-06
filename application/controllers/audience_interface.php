<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Audience_interface extends CI_Controller {
	
	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'');
	var $loginstatus = array('cus'=>FALSE,'aud'=>FALSE,'adm'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('customersmodel');
		$this->load->model('audiencemodel');
		$this->load->model('trendsmodel');
		$this->load->model('coursesmodel');
		$this->load->model('chaptermodel');
		$this->load->model('lecturesmodel');
		$this->load->model('testsmodel');
		$this->load->model('testquestionsmodel');
		$this->load->model('testanswersmodel');
		$this->load->model('unionmodel');
		$this->load->model('ordersmodel');
		$this->load->model('courseordermodel');
		$this->load->model('audienceordermodel');
		
		$cookieuid = $this->session->userdata('logon');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				if($this->session->userdata('utype') != 'aud'):
					redirect('');
				endif;
				$userinfo = $this->audiencemodel->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ulogin'] 			= $userinfo['login'];
					$this->user['uemail'] 			= '';
					$this->user['utype'] 			= $this->session->userdata('utype');
					$this->loginstatus['status'] 	= TRUE;
					$this->loginstatus[$this->user['utype']] = TRUE;
				endif;
			endif;
			
			if($this->session->userdata('logon') != md5($userinfo['login'])):
				$this->loginstatus['status'] = FALSE;
				$this->user = array();
			endif;
		else:
			redirect('');
		endif;
		
	}
	
	public function audience_profile(){

		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Профиль слушателя курсов',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'audience'		=> $this->audiencemodel->read_record($this->user['uid']),
					'customer'		=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$pagevar['customer'] = $this->customersmodel->read_field($pagevar['audience']['customer'],'organization');
		$pagevar['audience']['signupdate'] = $this->operation_date($pagevar['audience']['signupdate']);
		
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->view("audience_interface/audience-profile",$pagevar);
	}
	
	public function audience_courses_currect(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Мои текущие курсы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'courses'		=> $this->unionmodel->read_audience_currect_courses($this->user['uid'],0),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['courses']);$i++):
			$pagevar['courses'][$i]['chapter'] = $this->chaptermodel->count_records($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['tests'] = $this->testsmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['lectures'] = $this->lecturesmodel->count_course_record($pagevar['courses'][$i]['id']);
		endfor;
		
		$this->load->view("audience_interface/courses-currect",$pagevar);
	}
	
	public function audience_courses_completed(){
		
	}
	
	public function audience_start_training(){
		
		$training = $this->uri->segment(5);
		if($training):
			if(!$this->audienceordermodel->owner_audience($training,$this->user['uid'])):
				$this->session->set_userdata('msgr','Не возможно начать обучение.');
				redirect('audience/courses/current');
			endif;
			$this->audienceordermodel->update_field($training,'start',1);
		endif;
		redirect('audience/courses/current');
	}
	
	function operation_date($field){
			
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1 г."; 
		return preg_replace($pattern, $replacement,$field);
	}

	function operation_dot_date($field){
			
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5.$3.\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}
}