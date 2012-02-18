<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends CI_Controller{
	
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
					'newcourses'	=> $this->coursesmodel->read_new_courses(3)
			);
		$this->load->view("admin_interface/admin-panel",$pagevar);
	}
	
	public function admin_cabinet(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Личный кабинет',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(3)
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
					'newcourses'	=> $this->coursesmodel->read_new_courses(3),
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
				if(!$_POST['view']):
					$this->coursesmodel->deactive_status_trend($_POST['idt']);
				else:
					$this->coursesmodel->active_status_trend($_POST['idt']);
				endif;
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
				$this->coursesmodel->delete_trends($id);
				$this->session->set_userdata('msgs','Направление удалено успешно.');
			else:
				$this->session->set_userdata('msgr','Направление не удалено.');
			endif;
			redirect('admin-panel/references/trends');
		else:
			show_404();
		endif;
	}
	
	public function references_courses(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Список курсов',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'trends'		=> $this->trendsmodel->read_records(),
					'courses'		=> $this->coursesmodel->read_records(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(3),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('code',' ','required|trim');
			$this->form_validation->set_rules('price',' ','required|trim');
			$this->form_validation->set_rules('hours',' ','required|trim');
			$this->form_validation->set_rules('trend',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				if(!isset($_POST['view'])):
					$_POST['view'] = 0;
				endif;
				$id = $this->coursesmodel->insert_record($_POST);
				if($id):
					$this->trendsmodel->insert_course($_POST['trend']);
					$this->session->set_userdata('msgs','Курс создан успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('esubmit')):
			$_POST['esubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('code',' ','required|trim');
			$this->form_validation->set_rules('price',' ','required|trim');
			$this->form_validation->set_rules('hours',' ','required|trim');
			$this->form_validation->set_rules('icrs',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				if(!isset($_POST['view'])):
					$_POST['view'] = 0;
				endif;
				$this->coursesmodel->update_record($_POST);
				/*if(!$_POST['view']):
					$this->coursesmodel->deactive_status_trend($_POST['idt']);
				else:
					$this->coursesmodel->active_status_trend($_POST['idt']);
				endif;*/
				$this->session->set_userdata('msgs','Информация по курсу успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		$this->load->view("admin_interface/admin-courses-list",$pagevar);
	}
	
	public function references_delete_course(){
		
		$course = $this->uri->segment(5);
		$trend = $this->uri->segment(7);
		if($course || $trend):
			
			$chapters = $this->chaptermodel->read_records($course);
			for($i=0;$i<count($chapters);$i++):
				$lectures = $this->lecturesmodel->read_records_chapter($course,$chapters[$i]['id']);
				for($j=0;$j<count($lectures);$j++):
					$filepath = getcwd().'/'.$lectures[$j]['document'];
					$this->filedelete($filepath);
					$result = $this->lecturesmodel->delete_record($lectures[$j]['id']);
				endfor;
				$this->chaptermodel->delete_record($chapters[$i]['id']);
			endfor;
			$result = $this->coursesmodel->delete_record($course);
			if($result):
				$this->session->set_userdata('msgs','Курс удален успешно.');
				$this->trendsmodel->delete_courses($trend);
			else:
				$this->session->set_userdata('msgr','Курс не удален.');
			endif;
			redirect('admin-panel/references/courses');
		else:
			show_404();
		endif;
	}
	
	public function references_chapters(){
		
		$trend = $this->uri->segment(4);
		if(!$this->trendsmodel->exist_course($trend)):
			redirect('admin-panel/references/trends');
		endif;
		$course = $this->uri->segment(6);
		if(!$this->coursesmodel->ownew_course($course,$trend)):
			redirect('admin-panel/references/courses');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'chapters'		=> $this->chaptermodel->read_records($course),
					'lectures'		=> $this->lecturesmodel->read_records($course),
					'trend'			=> $this->trendsmodel->read_field($trend,'code'),
					'course'		=> $this->coursesmodel->read_field($course,'code'),
					'newcourses'	=> $this->coursesmodel->read_new_courses(3),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$pagevar['title'] .= 'Содержание курса "'.$pagevar['course'].'"'; 
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				$_POST['course'] = $course;
				$id = $this->chaptermodel->insert_record($_POST);
				if($id):
//					$this->trendsmodel->insert_course($_POST['trend']);
					$this->session->set_userdata('msgs','Глава добавлена успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('lsubmit')):
			$_POST['lsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				if($_FILES['document']['error'] == 4):
					$this->session->set_userdata('msgr','Ошибка при загрузке документа. Не указан файл.');
					redirect($this->uri->uri_string());
				endif;
				$_FILES['document']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['document']['name']);
				$_POST['document'] = 'documents/lectures/'.$_FILES['document']['name'];
				if(!$this->fileupload('document',FALSE)):
					$this->session->set_userdata('msgr','Ошибка при загрузке документа.');
					redirect($this->uri->uri_string());
				endif;
				$_POST['course'] = $course;
				$id = $this->lecturesmodel->insert_record($_POST);
				if($id):
//					$this->trendsmodel->insert_course($_POST['trend']);
					$this->session->set_userdata('msgs','Лекция добавлена успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-chapters-list",$pagevar);
	}
	
	public function references_delete_lecture(){
		
		$course = $this->uri->segment(6);
		$trend = $this->uri->segment(4);
		$lecture = $this->uri->segment(8);
		if($course || $trend || $lecture):
			$filepath = getcwd().'/'.$this->lecturesmodel->read_field($lecture,'document');
			if(!$this->filedelete($filepath)):
				$this->session->set_userdata('msgr','Отсутствует файл на диске.');
			endif;
			$result = $this->lecturesmodel->delete_record($lecture);
			if($result):
				$this->session->set_userdata('msgs','Лекция удалена успешно.');
			else:
				$this->session->set_userdata('msgr','Лекция не удалена.');
			endif;
			redirect('admin-panel/references/trend/'.$trend.'/course/'.$course);
		else:
			show_404();
		endif;
	}
	
	public function references_delete_chapter(){
		
		$course = $this->uri->segment(6);
		$trend = $this->uri->segment(4);
		$chapter = $this->uri->segment(8);
		$error = TRUE;
		if($course || $trend || $chapter):
			$lectures = $this->lecturesmodel->read_records_chapter($course,$chapter);
			for($i=0;$i<count($lectures);$i++):
				$filepath = getcwd().'/'.$lectures[$i]['document'];
				$this->filedelete($filepath);
				$result = $this->lecturesmodel->delete_record($lectures[$i]['id']);
				if(!$result):
					$error = FALSE;
					$this->session->set_userdata('msgr','Часть лекций не удалена.');
				endif;
			endfor;
			if($error):
				$this->chaptermodel->delete_record($chapter);
				$this->session->set_userdata('msgs','Глава удалена успешно.');
			endif;
			redirect('admin-panel/references/trend/'.$trend.'/course/'.$course);
		else:
			show_404();
		endif;
	}
	
	public function private_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Личные сообщения',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(3)
			);
		$this->load->view("admin_interface/admin-private-messages",$pagevar);
	}
	
	public function support_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Техническая поддержка',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(3)
			);
		$this->load->view("admin_interface/admin-support-messages",$pagevar);
	}
	
	public function applications_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - Заявки',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(3)
			);
		$this->load->view("admin_interface/admin-applications-messages",$pagevar);
	}

	public function fileupload($userfile,$overwrite){
		
		$this->load->library('upload');
		$config['upload_path'] 		= getcwd().'/documents/lectures/';
		$config['allowed_types'] 	= 'doc|docx|xls|xlsx|txt|pdf';
		$config['remove_spaces'] 	= TRUE;
		$config['overwrite'] 		= $overwrite;
		$this->upload->initialize($config);
		if(!$this->upload->do_upload($userfile)):
			return FALSE;
		endif;
		return TRUE;
	}

	public function filedelete($file){
		
		if(is_file($file)):
			@unlink($file);
			return TRUE;
		else:
			return FALSE;
		endif;
	}
}