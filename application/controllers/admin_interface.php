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
					'userinfo'		=> $this->user
			);
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
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Список направлений обучения',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'trends'		=> $this->trendsmodel->read_records(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('code',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Направление не создано. Не заполены необходимые поля.');
			else:
				if(!isset($_POST['view'])):
					$_POST['view'] = 0;
				endif;
				$id = $this->trendsmodel->insert_record($_POST);
				if($id):
					$this->session->set_userdata('msgs','Направление создано успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('esubmit')):
			$_POST['esubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('code',' ','required|trim');
			$this->form_validation->set_rules('idt',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				if(!isset($_POST['view'])):
					$_POST['view'] = 0;
				endif;
				$this->trendsmodel->update_record($_POST);
				$this->session->set_userdata('msgs','Информация по направлению успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-trends-list",$pagevar);
	}
	
	public function references_delete_trend(){
		
		$id = $this->uri->segment(5);
		if($id):
			$result = $this->trendsmodel->delete_record($id);
			if($result):
				$this->session->set_userdata('msgs','Направление удалено успешно.');
			else:
				$this->session->set_userdata('msgr','Направление не удалено.');
			endif;
			redirect('admin-panel/references/trends');
		endif;
	}
	
	public function references_courses(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Список курсов',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		$this->load->view("admin_interface/admin-courses-list",$pagevar);
	}

	public function private_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Личные сообщения',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		$this->load->view("admin_interface/admin-private-messages",$pagevar);
	}
	
	public function support_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Техническая поддержка',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		$this->load->view("admin_interface/admin-support-messages",$pagevar);
	}
	
	public function applications_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Заявки',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		$this->load->view("admin_interface/admin-applications-messages",$pagevar);
	}
}