<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends CI_Controller{
	
	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'');
	var $loginstatus = array('cus'=>FALSE,'aud'=>FALSE,'adm'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('adminmodel');
		
		$cookieuid = $this->session->userdata('logon');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				$model = $this->definition_model($this->session->userdata('utype'));
				$userinfo = $this->$model->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ulogin'] 			= $userinfo['login'];
					$this->user['uemail'] 			= '';
					$this->user['utype'] 			= $this->session->userdata('utype');
					$this->loginstatus['status'] 	= TRUE;
					$this->loginstatus[$this->user['utype']] = TRUE;
				endif;
			endif;
			
			if($this->session->userdata('logon') != md5($userinfo['login'].$userinfo['password'])):
				$this->loginstatus['status'] = FALSE;
				$this->user = array();
			endif;
		endif;
	}
	
	public function index(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр Дополнительного Профессионального Обучения',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user
			);
		$this->load->view("users_interface/index",$pagevar);
	}

	public function admin_login(){
	
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Панель администрирования',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus['status'],
					'userinfo'		=> $this->user,
					'form_title'	=> 'Введите логин и пароль для входа в панель администрирования',
					'msg'			=> $this->session->userdata('msg')
			);
		$this->session->unset_userdata('msg');
		if($this->input->post('submit')):
			$_POST['submit'] == NULL;
			$userinfo = $this->adminmodel->auth_user($this->input->post('login'),$this->input->post('password'));
			if(!$userinfo):
				$this->session->set_userdata('msg','Имя пользователя и пароль не совпадают');
				redirect($this->uri->uri_string());
			else:
				$session_data = array('logon'=>md5($userinfo['login'].$userinfo['password']),'userid'=>$userinfo['id'],'utype'=>substr($userinfo['login'],0,3));
                $this->session->set_userdata($session_data);
                redirect("admin-panel/actions/control");
			endif;
		endif;
		if($this->loginstatus['status']):
			if($this->loginstatus['adm']):
				redirect('admin-panel/actions/control');
			elseif($this->loginstatus['cus']):
				redirect('');
			elseif($this->loginstatus['aud']):
				redirect('');
			endif;
		endif;
		$this->load->view("users_interface/admin-login",$pagevar);
	}

	public function definition_model($utype){
		
		$model = '';
		switch ($utype):
			case 'adm': $model = 'adminmodel'; break;
			case 'cus': $model = 'companymodel'; break;
			case 'aud': $model = 'audiencemodel'; break;
		endswitch;
		return $model;
	}
}