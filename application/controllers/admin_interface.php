<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends CI_Controller {
	
	var $user = array('uid'=>0,'cid'=>0,'ufullname'=>'','ulogin'=>'','uemail'=>'');
	var $loginstatus = array('admin'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('adminmodel');
		$this->load->model('trendsmodel');
		$this->load->model('coursesmodel');
		$this->load->model('chaptermodel');
		$this->load->model('lecturesmodel');
		$this->load->model('testsmodel');
		$this->load->model('testquestionsmodel');
		$this->load->model('testanswersmodel');
		
		$cookieuid = $this->session->userdata('logon');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				$userinfo = $this->adminmodel->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ulogin'] 			= $userinfo['login'];
					$this->user['uemail'] 			= '';
					$this->user['utype'] 			= $this->session->userdata('utype');
					$this->loginstatus['status'] 	= TRUE;
					$this->loginstatus['admin'] = TRUE;
				else:
					redirect('');
				endif;
			endif;
			
			if($this->session->userdata('logon') != md5($userinfo['login'].$userinfo['password'])):
				$this->loginstatus['status'] = FALSE;
				redirect('');
			endif;
		else:
			redirect('');
		endif;
	}
	
	public function index(){

		$this->load->view("admin_interface/index");
	}
	
	public function admin_panel(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Панель администрирования',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'paramstatus'	=> array('trend'=>$this->session->userdata('trend'),'course'=>$this->session->userdata('course'),'chapter'=>$this->session->userdata('chapter'),'lecture'=>$this->session->userdata('lecture'),'test'=>$this->session->userdata('test'),'tansw'=>$this->session->userdata('tansw'),'tqes'=>$this->session->userdata('tqes')),
					'paramvalue'	=> array('trend'=>'','course'=>'','chapter'=>'','lecture'=>'','test'=>'','tqes'=>'','tansw'=>'')
			);
		$pagevar['paramvalue']['trend'] = $this->trendsmodel->read_field($pagevar['paramstatus']['trend'],'title');
		$pagevar['paramvalue']['course'] = $this->coursesmodel->read_field($pagevar['paramstatus']['course'],'title');
		$pagevar['paramvalue']['chapter'] = $this->chaptermodel->read_field($pagevar['paramstatus']['chapter'],'title');
		$pagevar['paramvalue']['lecture'] = $this->lecturesmodel->read_field($pagevar['paramstatus']['lecture'],'title');
		$pagevar['paramvalue']['test'] = $this->testsmodel->read_field($pagevar['paramstatus']['test'],'title');
		$pagevar['paramvalue']['tqes'] = $this->testquestionsmodel->read_field($pagevar['paramstatus']['tqes'],'title');
		$pagevar['paramvalue']['tansw'] = $this->testanswersmodel->read_field($pagevar['paramstatus']['tansw'],'title');
		
		$this->load->view("admin_interface/admin-panel",$pagevar);
	}
	
	public function admin_cabinet(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Личный кабинет',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		$this->load->view("admin_interface/admin-cabinet",$pagevar);
	}

	public function admin_logoff(){
		
		$this->adminmodel->deactive_user($this->session->userdata('userid'));
		$this->session->sess_destroy();
        redirect('');
	}

	/******************************************************** references **********************************************************/
	
	public function references_trends(){
		
	}
	
	public function references_courses(){
		
	}
}