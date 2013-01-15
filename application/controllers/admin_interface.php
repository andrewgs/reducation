<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends CI_Controller{
	
	var $user = array('uid'=>0,'cid'=>0,'ufullname'=>'','ulogin'=>'','uemail'=>'');
	var $loginstatus = array('admin'=>FALSE,'status'=>FALSE);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля","05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа","09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('adminmodel');
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
		$this->load->model('audiencetestmodel');
		$this->load->model('testresultsmodel');
		$this->load->model('calendarmodel');
		$this->load->model('physicalmodel');
		$this->load->model('fizordersmodel');
		$this->load->model('fizunionmodel');
		$this->load->model('fizcoursemodel');
		$this->load->model('fiztestresultsmodel');
		$this->load->model('fiztestmodel');
		
		$cookieuid = $this->session->userdata('logon');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				if($this->session->userdata('utype') != 'adm'):
					redirect('');
				endif;
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
			
			if($this->session->userdata('logon') != md5($userinfo['login'])):
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
	
	public function send_user_email(){
	
		$id = $this->uri->segment(5);
		$type = $this->uri->segment(4);
		if($id && $type):
			switch($type):
				case 'customer' : 	$info = $this->customersmodel->read_record($id);
									if($info):
										$email = $info['personemail'];
										ob_start();
										?>
										<p><strong>Здравствуйте, <?=$info['organization']?></strong></p>
										<p>Поздравляем! Вы успешно завершили оформление заявки. Вам доступны следующие документы:</p>
										<ol>
											<li>Счёт</li>
											<li>Договор на оказание образовательных услуг</li>
										</ol>
										<p>
											После оплаты заказа мы оформим весь пакет документов, а слушатели будут зачислены на обучение. 
											Обучение будет осуществляться через личный кабинет слушателя. Для входа в личный кабинет используйте 
											созданный для вас логин и пароль.
										</p>
										<p><strong>Логин: <span style="font-size: 24px;"><?=$info['login'];?></span> Пароль: <span style="font-size: 24px;"><?=$this->encrypt->decode($info['cryptpassword']);?></span></strong></p>
										<p>Пользуйтесь разделом «Мои заказы» на правой панели, чтобы следить за состоянием Ваших заказов.</p>
										<br/><br/>
										<p>
											Наш адрес: г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
											Контактные данные: (863) 273-66-61, (863) 246-43-54<br/>
											Эл.почта: info@roscentrdpo.ru<br/>
											С уважением:<br/>Южно-окружной центр повышения квалификации и переподготовки кадров для строительного и жилищно-коммунального комплекса
										</p>
										<?
										$mailtext = ob_get_clean();
									endif;
									break;
				case 'audience' : 	$info = $this->audiencemodel->read_record($id);
									if($info):
										$email = $info['personaemail'];
										ob_start();
										?>
										<p>Здравствуйте,  <?=$info['lastname'].' '.$info['name'].' '.$info['middlename'];?></p>
										<p>
											Поздравляем! Вас успешно зарегистрировали в статусе слушателя. 
											Обучение будет осуществляться через личный кабинет.
											Для входа в личный кабинет используйте присвоенные вам логин и пароль.
										</p>
										<p><strong>Логин: <span style="font-size: 24px;"><?=$info['login'];?></span> Пароль: <span style="font-size: 24px;"><?=$this->encrypt->decode($info['cryptpassword']);?></span></strong></p>
										<br/><br/>
										<p>
											Наш адрес: г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
											Контактные данные: (863) 273-66-61, (863) 246-43-54<br/>
											Эл.почта: info@roscentrdpo.ru<br/>
											С уважением:<br/>Южно-окружной центр повышения квалификации и переподготовки кадров для строительного и жилищно-коммунального комплекса
										</p>
										<?
										$mailtext = ob_get_clean();
									endif;
									break;
				case 'physical' : 	$info = $this->physicalmodel->read_record($id);
									if($info):
										$email = $info['email'];
										ob_start();
										?>
										<p><strong>Здравствуйте, <?=$info['fio']?></strong></p>
										<p>Поздравляем! Вы успешно завершили оформление заявки. Вам доступны следующие документы:</p>
										<ol>
											<li>Счёт</li>
											<li>Договор на оказание образовательных услуг</li>
										</ol>
										<p>
											После оплаты заказа мы оформим весь пакет документов, а слушатели будут зачислены на обучение. 
											Обучение будет осуществляться через личный кабинет слушателя. Для входа в личный кабинет используйте 
											созданный для вас логин и пароль.
										</p>
										<p><strong>Логин: <span style="font-size: 24px;"><?=$info['login'];?></span> Пароль: <span style="font-size: 24px;"><?=$this->encrypt->decode($info['cryptpassword']);?></span></strong></p>
										<p>Пользуйтесь разделом «Мои заказы» на правой панели, чтобы следить за состоянием Ваших заказов.</p>
										<br/><br/>
										<p>
											Наш адрес: г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
											Контактные данные: (863) 273-66-61, (863) 246-43-54<br/>
											Эл.почта: info@roscentrdpo.ru<br/>
											С уважением:<br/>Южно-окружной центр повышения квалификации и переподготовки кадров для строительного и жилищно-коммунального комплекса
										</p>
										<?
										$mailtext = ob_get_clean();
									endif;
									break;
				default 		: 	show404();
									break;
			endswitch;
			if($info && isset($mailtext)):
				
				$this->email->clear(TRUE);
				$config['smtp_host'] = 'localhost';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				
				$this->email->initialize($config);
				$this->email->to($email);
				$this->email->from('admin@roscentrdpo.ru','АНО ДПО');
				$this->email->bcc('');
				$this->email->subject('Данные для доступа к личному кабинету');
				$this->email->message($mailtext);
				if($this->email->send()):
					$this->session->set_userdata('msgs','Успешно. Уведомление отправлено.');
				else:
					$this->session->set_userdata('msgr','Ошибка. Уведомление не отправлено.');
				endif;
			endif;
		endif;
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function admin_panel(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Панель администрирования',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'seldate'		=> $this->calendarmodel->read_records(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['seldate']);$i++):
			$pagevar['seldate'][$i]['date'] = $this->operation_date($pagevar['seldate'][$i]['date']);
		endfor;
		
		if($this->input->post('catkurs')):
			$_POST['catkurs'] = NULL;
			if($_FILES['document']['error'] == 1):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа. Размер принятого файла превысил максимально допустимый размер.');
				redirect($this->uri->uri_string());
			endif;
			if($_FILES['document']['error'] == 4):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа. Не указан файл.');
				redirect($this->uri->uri_string());
			endif;
			$_FILES['document']['name'] = preg_replace('/.+(.)(\.)+/','courses_list'."\$2", $_FILES['document']['name']);
			$config['upload_path'] 		= getcwd();
			$config['allowed_types'] 	= 'xls';
			$config['remove_spaces'] 	= TRUE;
			$config['overwrite'] 		= TRUE;
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('document')):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа.');
				redirect($this->uri->uri_string());
			endif;
			$this->session->set_userdata('msgs','Список каталогов курсов загружен успешно.');
			redirect($this->uri->uri_string());
		endif;
		
		if($this->input->post('adddate')):
			$_POST['adddate'] = NULL;
			$this->form_validation->set_rules('date',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Дата не добавлена. Не заполены необходимые поля.');
			else:
				$pattern = "/(\d+)\.(\w+)\.(\d+)/i";
				$replacement = "\$3-\$2-\$1";
				$_POST['date'] = preg_replace($pattern,$replacement,$_POST['date']);
				if($this->calendarmodel->exist_date($_POST['date'])):
					$this->session->set_userdata('msgr','Дата уже существует.');
					redirect($this->uri->uri_string());
				endif;
				$id = $this->calendarmodel->insert_record($_POST['date']);
				if($id):
					$this->session->set_userdata('msgs','Дата добавлена успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-panel",$pagevar);
	}
	
	public function admin_cabinet(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Личный кабинет',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5)
			);
		$this->load->view("admin_interface/admin-cabinet",$pagevar);
	}

	public function admin_logoff(){
		
		$this->adminmodel->deactive_user($this->session->userdata('userid'));
		$this->session->sess_destroy();
		redirect('');
	}

	public function datele_date(){
		
		$id = $this->uri->segment(5);
		if($id):
			$result = $this->calendarmodel->delete_record($id);
			if($result):
				$this->session->set_userdata('msgs','Дата удалена успешно.');
			else:
				$this->session->set_userdata('msgr','Дата не удалена.');
			endif;
			redirect('admin-panel/actions/control');
		else:
			show_404();
		endif;
	}

	/******************************************************** references ****************************************************/
	
	public function references_trends(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Список направлений обучения',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'trends'		=> $this->trendsmodel->read_records(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
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
				/*if(!isset($_POST['view'])):
					$_POST['view'] = 0;
				endif;*/
				$_POST['view'] = 1;
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
				/*if(!isset($_POST['view'])):
					$_POST['view'] = 0;
				endif;*/
				$_POST['view'] = 1;
				$this->trendsmodel->update_record($_POST);
				/*if(!$_POST['view']):
					$this->coursesmodel->deactive_status_trend($_POST['idt']);
				else:
					$this->coursesmodel->active_status_trend($_POST['idt']);
				endif;*/
				$this->session->set_userdata('msgs','Информация по направлению успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-trends-list",$pagevar);
	}
	
	public function references_delete_trend(){
		
		$trend = $this->uri->segment(5);
		if($trend):
			$courses = $this->coursesmodel->exist_courses_trend($trend);
			if($courses):
				$this->session->set_userdata('msgr','Направление не удалено. Направление имеет вложенные курсы.');
				redirect('admin-panel/references/trends');
			endif;
			$result = $this->trendsmodel->delete_record($trend);
			if($result):
				$this->coursesmodel->delete_trends($trend);
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
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Список курсов',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'trends'		=> $this->trendsmodel->read_records(),
					'courses'		=> $this->coursesmodel->read_records(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
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
				$test = $this->testsmodel->read_record_chapter($chapters[$i]['id']);
				if($test):
					$this->testanswersmodel->delete_records_course($course);
					$this->testquestionsmodel->delete_records_course($course);
					$this->testsmodel->delete_record($test['id']);
				endif;
				$this->chaptermodel->delete_record($chapters[$i]['id']);
			endfor;
			$this->testsmodel->delete_final_test($course);
			$libraries = getcwd().'/'.$this->coursesmodel->read_field($course,'libraries');
			$this->filedelete($libraries);
			$curriculum = getcwd().'/'.$this->coursesmodel->read_field($course,'curriculum');
			$this->filedelete($curriculum);
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
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'chapters'		=> $this->chaptermodel->read_records($course),
					'lectures'		=> $this->lecturesmodel->read_records($course),
					'trend'			=> $this->trendsmodel->read_field($trend,'code'),
					'course'		=> $this->coursesmodel->read_field($course,'code'),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'finaltest'		=> $this->testsmodel->read_final_test($course),
					'cntchapter'	=> $this->chaptermodel->count_records($course),
					'document'		=> $this->coursesmodel->read_field($course,'libraries'),
					'docvalue'		=> 'Список литературы',
					'curriculum'	=> $this->coursesmodel->read_field($course,'curriculum'),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$pagevar['title'] .= 'Содержание курса "'.$pagevar['course'].'"';
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['chapters']);$i++):
			$pagevar['chapters'][$i]['test'] = $this->testsmodel->read_record_chapter($pagevar['chapters'][$i]['id']);
			$pagevar['chapters'][$i]['clectures'] = $this->lecturesmodel->count_records($pagevar['chapters'][$i]['id']);
		endfor;
		if(!$pagevar['finaltest']):
			$insertdata = array('title'=>'Итоговое тестирование по курсу "'.$pagevar['course'].'"','count'=>5,'time'=>30,'number'=>0,'chapter'=>0,'course'=>$course);
			$idtest = $this->testsmodel->insert_record($insertdata);
			$pagevar['finaltest'] = $this->testsmodel->read_record($idtest);
			$msgs = '<br/>Итоговое тестирование добавлено успешно.';
			$update_test = $this->session->flashdata('closed_test');
			$aud_tests = $this->audiencetestmodel->open_orders_final_tests($update_test);
			if($aud_tests):
				$cnt = 0;
				for($i=0;$i<count($aud_tests);$i++):
					$this->audiencetestmodel->update_field($aud_tests[$i]['id'],'test',$idtest);
					$cnt++;
				endfor;
				$msgs .= '<br/>Произошла замена тестов у слушателей. Количество замен:'.$cnt;
			endif;
			$fiz_tests = $this->fiztestmodel->open_orders_final_tests($update_test);
			if($fiz_tests):
				$cnt = 0;
				for($i=0;$i<count($fiz_tests);$i++):
					$this->fiztestmodel->update_field($fiz_tests[$i]['id'],'test',$idtest);
					$cnt++;
				endfor;
				$msgs .= '<br/>Произошла замена тестов у физ.лиц. Количество замен:'.$cnt;
			endif;
			$pagevar['msgs'] .= $msgs;
		endif;
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				$_POST['course'] = $course;
				$_POST['number'] = $this->chaptermodel->next_number($course);
				$id = $this->chaptermodel->insert_record($_POST);
				if($id):
					$insertdata = array('title'=>'Итоговое тестирование по курсу "'.$pagevar['course'].'"','count'=>5,'time'=>30,'number'=>0,'chapter'=>0,'course'=>$course);
					$this->testsmodel->insert_record($insertdata);
					$this->session->set_userdata('msgs','Глава добавлена успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('echsubmit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				$_POST['course'] = $course;
				$oldnumber = $this->chaptermodel->read_field($_POST['idchp'],'number');
				if($oldnumber != $_POST['number']):
					$this->chaptermodel->change_number($_POST['number'],$oldnumber,$course);
				endif;
				$this->chaptermodel->update_record($_POST);
				$this->session->set_userdata('msgs','Глава успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('lsubmit')):
			$_POST['lsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('chapter',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				if($_FILES['document']['error'] == 1):
					$this->session->set_userdata('msgr','Ошибка при загрузке документа. Размер принятого файла превысил максимально допустимый размер.');
					redirect($this->uri->uri_string());
				endif;
				if($_FILES['document']['error'] == 4):
					$this->session->set_userdata('msgr','Ошибка при загрузке документа. Не указан файл.');
					redirect($this->uri->uri_string());
				endif;
				$_FILES['document']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['document']['name']);
				$_POST['document'] = 'documents/lectures/'.$_FILES['document']['name'];
				if(!$this->fileupload('document',FALSE,'lectures')):
					$this->session->set_userdata('msgr','Ошибка при загрузке документа.');
					redirect($this->uri->uri_string());
				endif;
				$_POST['number'] = $this->lecturesmodel->next_number($_POST['chapter']);
				$_POST['course'] = $course;
				$id = $this->lecturesmodel->insert_record($_POST);
				if($id):
					$this->session->set_userdata('msgs','Лекция добавлена успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('lbsubmit')):
			$_POST['lbsubmit'] = NULL;
			if($_FILES['document']['error'] == 1):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа. Размер принятого файла превысил максимально допустимый размер.');
				redirect($this->uri->uri_string());
			endif;
			if($_FILES['document']['error'] == 4):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа. Не указан файл.');
				redirect($this->uri->uri_string());
			endif;
			$_FILES['document']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['document']['name']);
			$document = 'documents/libraries/'.$_FILES['document']['name'];
			$olddoc = $this->coursesmodel->read_field($course,'libraries');
			if(!$this->fileupload('document',FALSE,'libraries')):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа.');
				redirect($this->uri->uri_string());
			else:
				$this->filedelete($olddoc);
			endif;
			$this->coursesmodel->update_library($course,$document);
			$this->session->set_userdata('msgs','Список литературы добавлен успешно.');
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('crsubmit')):
			$_POST['crsubmit'] = NULL;
			if($_FILES['document']['error'] == 1):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа. Размер принятого файла превысил максимально допустимый размер.');
				redirect($this->uri->uri_string());
			endif;
			if($_FILES['document']['error'] == 4):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа. Не указан файл.');
				redirect($this->uri->uri_string());
			endif;
			$_FILES['document']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['document']['name']);
			$document = 'documents/curriculum/'.$_FILES['document']['name'];
			$olddoc = $this->coursesmodel->read_field($course,'curriculum');
			if(!$this->fileupload('document',FALSE,'curriculum')):
				$this->session->set_userdata('msgr','Ошибка при загрузке документа.');
				redirect($this->uri->uri_string());
			else:
				$this->filedelete($olddoc);
			endif;
			$this->coursesmodel->update_curriculum($course,$document);
			$this->session->set_userdata('msgs','Учебный план добавлен успешно.');
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('elsubmit')):
			$_POST['elsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			$this->form_validation->set_rules('idlec',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				if($_FILES['document']['error'] != 4):
					$_FILES['document']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['document']['name']);
					$_POST['document'] = 'documents/lectures/'.$_FILES['document']['name'];
					if(!$this->fileupload('document',FALSE,'lectures')):
						$this->session->set_userdata('msgr','Ошибка при загрузке документа.');
						redirect($this->uri->uri_string());
					else:
						$document = $this->lecturesmodel->read_field($_POST['idlec'],'document');
						$this->filedelete($document);
					endif;
				else:
					$_POST['document'] = '';
				endif;
				$oldnumber = $this->lecturesmodel->read_field($_POST['idlec'],'number');
				if($oldnumber != $_POST['number']):
					$this->lecturesmodel->change_number($_POST['number'],$oldnumber,$_POST['idchp']);
				endif;
				$this->lecturesmodel->update_record($_POST);
				$this->session->set_userdata('msgs','Информация по курсу успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('mtsubmit')):
			$_POST['mtsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('count',' ','required|trim');
			$this->form_validation->set_rules('time',' ','required|trim');
			$this->form_validation->set_rules('chapter',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				$_POST['course'] = $course;
				$_POST['number'] = $this->chaptermodel->read_field($_POST['chapter'],'number');
				$id = $this->testsmodel->insert_record($_POST);
				if($id):
					$msgs = 'Промежуточное тестирование добавлено успешно.';
					$aud_tests = $this->audiencetestmodel->open_tests($_POST['chapter']);
					if($aud_tests):
						$cnt = 0;
						for($i=0;$i<count($aud_tests);$i++):
							$this->audiencetestmodel->update_field($aud_tests[$i]['id'],'test',$id);
							$cnt++;
						endfor;
						$msgs .= '<br/>Произошла замена тестов у слушателей. Количество замен:'.$cnt;
					endif;
					$this->session->set_userdata('msgs',$msgs);
					$this->chaptermodel->active_test($_POST['chapter']);
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('emtsubmit')):
			$_POST['emtsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('count',' ','required|trim');
			$this->form_validation->set_rules('time',' ','required|trim');
			$this->form_validation->set_rules('idt',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				$_POST['course'] = $course;
				$_POST['number'] = $this->chaptermodel->read_field($_POST['chapter'],'number');
				$id = $this->testsmodel->update_record($_POST);
				$this->session->set_userdata('msgs','Информация о промежуточном тестировании сохранена успешно.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('eftsubmit')):
			$_POST['eftsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('count',' ','required|trim');
			$this->form_validation->set_rules('time',' ','required|trim');
			$this->form_validation->set_rules('idt',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				$_POST['course'] = $course;
				$_POST['number'] = 0;
				$id = $this->testsmodel->update_record($_POST);
				$this->session->set_userdata('msgs','Информация о итоговом тестировании сохранена успешно.');
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
				$curriculum = getcwd().'/'.$this->lecturesmodel->read_field($lectures[$i]['id'],'curriculum');
				$this->filedelete($curriculum);
				$result = $this->lecturesmodel->delete_record($lectures[$i]['id']);
				if(!$result):
					$error = FALSE;
					$this->session->set_userdata('msgr','Часть лекций не удалена.');
				endif;
			endfor;
			$test = $this->testsmodel->read_record_chapter($chapter);
			if($test):
				$this->testanswersmodel->delete_records_course($course);
				$this->testquestionsmodel->delete_records_course($course);
				$this->testsmodel->delete_record($test['id']);
			endif;
			if($error):
				$this->chaptermodel->delete_record($chapter);
				$this->session->set_userdata('msgs','Глава удалена успешно.');
			endif;
			redirect('admin-panel/references/trend/'.$trend.'/course/'.$course);
		else:
			show_404();
		endif;
	}
	
	public function references_lecture_card(){
		
		$trend = $this->uri->segment(4);
		if(!$this->trendsmodel->exist_course($trend)):
			redirect('admin-panel/references/trends');
		endif;
		$course = $this->uri->segment(6);
		if(!$this->coursesmodel->ownew_course($course,$trend)):
			redirect('admin-panel/references/courses');
		endif;
		$lecture = $this->uri->segment(8);
		if(!$this->lecturesmodel->ownew_course($lecture,$course)):
			redirect('admin-panel/references/courses');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'lecture'		=> $this->lecturesmodel->read_record($lecture),
					'trend'			=> $this->trendsmodel->read_field($trend,'code'),
					'course'		=> $this->coursesmodel->read_field($course,'code'),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'filesize'		=> 'Размер не определен.',
					'filename'		=> 'Имя не определено. Возможно файл отсутствует на диске или не доступен',
					'fileextension'	=> 'Hасширение не определено.',
					'document'		=> '',
					'docvalue'		=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$pagevar['title'] .= 'Содержание курса "'.$pagevar['course'].'"'; 
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$file = getcwd().'/'.$pagevar['lecture']['document'];
		$pagevar['document'] = $pagevar['lecture']['document'];
		$pagevar['docvalue'] = $pagevar['lecture']['title'];
		if(file_exists($file)):
			$pagevar['filesize'] = filesize($file);
			$fileexp = explode('/',$pagevar['lecture']['document']);
			if($fileexp && isset($fileexp[2])):
				$pagevar['filename'] = $fileexp[2];
				$fileextension = explode('.',$pagevar['filename']);
				$pagevar['fileextension'] = $fileextension[1];
			endif;
		endif;
		if($pagevar['filesize'] > 1048576):
			$pagevar['filesize'] = round($pagevar['filesize']/1048576,2).' Мбайт';
		elseif($pagevar['filesize'] > 1024):
			$pagevar['filesize'] = round($pagevar['filesize']/1024,1).' кбайт';
		elseif($pagevar['filesize'] < 1024):
			$pagevar['filesize'] = $pagevar['filesize'].' байт';
		endif;
		$this->load->view("admin_interface/admin-lecture-card",$pagevar);
	}
	
	public function references_delete_test(){
		
		$trend = $this->uri->segment(4);
		$course = $this->uri->segment(6);
		$chapter = $this->uri->segment(8);
		$test = $this->uri->segment(10);
		if($chapter || $test):
			// nут удаляются ответы и вопросы
			$this->testsmodel->update_field($test,'active',0);
			if(!$chapter):
				$this->testsmodel->deactive_tests($course);
				$this->session->set_flashdata('closed_test',$test);
			endif;
//			$this->testsmodel->delete_record($test);
			$this->chaptermodel->deactive_test($chapter);
			$this->session->set_userdata('msgs','Тест удален успешно.');
			redirect('admin-panel/references/trend/'.$trend.'/course/'.$course);
		else:
			show_404();
		endif;
	}
	
	public function references_edit_test(){
		
		$trend = $this->uri->segment(4);
		if(!$this->trendsmodel->exist_course($trend)):
			redirect('admin-panel/references/trends');
		endif;
		$course = $this->uri->segment(6);
		if(!$this->coursesmodel->ownew_course($course,$trend)):
			redirect('admin-panel/references/courses');
		endif;
		$chapter = $this->uri->segment(8);
		$test	= $this->uri->segment(10);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'trend'			=> $this->trendsmodel->read_field($trend,'code'),
					'course'		=> $this->coursesmodel->read_field($course,'code'),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'questions'		=> $this->testquestionsmodel->read_records($test),
					'answers'		=> $this->testanswersmodel->read_records($test),
					'test'			=> $this->testsmodel->read_record($test),
					'cntquestions'	=> $this->testquestionsmodel->count_records($test),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$pagevar['title'] .= 'Содержание теста "'.$pagevar['test']['title'].'"';
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');

		if($this->input->post('qsubmit')):
			$_POST['qsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				$_POST['course'] = $course;	$_POST['test'] = $test;	$_POST['chapter'] = $chapter;
				$id = $this->testquestionsmodel->insert_record($_POST);
				if($id):
					$this->session->set_userdata('msgs','Вопрос добавлен успешно.');
				endif;
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('eqsubmit')):
			$_POST['eqsubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			$this->form_validation->set_rules('idqes',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				$oldnumber = $this->testquestionsmodel->read_field($_POST['idqes'],'number');
				if($oldnumber != $_POST['number']):
					$this->testquestionsmodel->change_number($_POST['number'],$oldnumber,$test);
				endif;
				$this->testquestionsmodel->update_record($_POST);
				$this->session->set_userdata('msgs','Вопрос сохранен успешно.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('asubmit')):
			$_POST['asubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('idqes',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при добавлении. Не заполены необходимые поля.');
			else:
				if(!isset($_POST['correct'])):
					$_POST['correct'] = 0;
				endif;
				$_POST['course'] = $course;	$_POST['test'] = $test;	$_POST['chapter'] = $chapter; 
				$_POST['number'] = $this->testanswersmodel->next_number($_POST['idqes']);
				$this->testanswersmodel->insert_record($_POST);
				$this->session->set_userdata('msgs','Ответ добавлен успешно.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		if($this->input->post('easubmit')):
			$_POST['easubmit'] = NULL;
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			$this->form_validation->set_rules('idans',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				if(!isset($_POST['correct'])):
					$_POST['correct'] = 0;
				endif;
				$oldnumber = $this->testanswersmodel->read_field($_POST['idans'],'number');
				if($oldnumber != $_POST['number']):
					$this->testanswersmodel->change_number($_POST['number'],$oldnumber,$_POST['idqes']);
				endif;
				$this->testanswersmodel->update_record($_POST);
				$this->session->set_userdata('msgs','Ответ успешно сохранен.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-test-edit",$pagevar);
	}
	
	public function references_delete_question(){
		
		$trend = $this->uri->segment(4);
		$course = $this->uri->segment(6);
		$chapter = $this->uri->segment(8);
		$test = $this->uri->segment(10);
		$question = $this->uri->segment(12);
		if($test || $question):
			$this->testanswersmodel->delete_records_question($question);
			$this->testquestionsmodel->delete_record($question);
			$this->session->set_userdata('msgs','Вопрос удален успешно.');
			redirect('admin-panel/references/trend/'.$trend.'/course/'.$course.'/chapter/'.$chapter.'/testing/'.$test);
		else:
			show_404();
		endif;
	}
	
	public function references_delete_answer(){
		
		$trend = $this->uri->segment(4);
		$course = $this->uri->segment(6);
		$chapter = $this->uri->segment(8);
		$test = $this->uri->segment(10);
		$answer = $this->uri->segment(12);
		if($test || $answer):
			$this->testanswersmodel->delete_record($answer);
			$this->session->set_userdata('msgs','Ответ удален успешно.');
			redirect('admin-panel/references/trend/'.$trend.'/course/'.$course.'/chapter/'.$chapter.'/testing/'.$test);
		else:
			show_404();
		endif;
	}
	
	public function references_master_test(){
		
		$answers = $this->input->post('answers');
		if(!$answers) show_404();
		$idqes = $this->testquestionsmodel->insert_ajax_record($answers[count($answers)-1]['numb'],$answers[count($answers)-1]['question'],$this->uri->segment(10),$this->uri->segment(8),$this->uri->segment(6));
		if($idqes):
			for($i=0;$i<count($answers)-1;$i++):
				if(!empty($answers[$i]['title'])):
					$this->testanswersmodel->insert_ajax_record($i+1,$answers[$i]['title'],$this->uri->segment(10),$this->uri->segment(8),$this->uri->segment(6),$answers[$i]['correct'],$idqes);
				endif;
			endfor;
		endif;
	}
	
	/******************************************************** messages ********************************************************/
	
	public function private_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Личные сообщения',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5)
			);
		$this->load->view("admin_interface/admin-private-messages",$pagevar);
	}
	
	public function support_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Техническая поддержка',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5)
			);
		$this->load->view("admin_interface/admin-support-messages",$pagevar);
	}
	
	public function orders_messages(){

		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> array(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'count'			=> 0,
					'pages'			=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$from = intval($this->uri->segment(5));
		if($this->uri->total_segments() >= 6):
			$field = $this->uri->segment(5);
			$sortby = $this->uri->segment(6);
			$from = intval($this->uri->segment(7));
			$fvalue = array('','id','paiddate','closedate','organization','userpaiddate');
			if(!array_search($field,$fvalue)):
				show_404();
			endif;
			$svalue = array('','desc','asc');
			if(!array_search($sortby,$svalue,true)):
				show_404();
			endif;
		endif;
		if(empty($sortby) || empty($field)):
			$sortby = 'desc';
			$field = 'id';
		endif;
		switch ($this->uri->segment(4)):
			case 'active' 	:	$pagevar['title'] .= 'В работе';
								$pagevar['orders'] = $this->unionmodel->read_customer_active_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->unionmodel->count_customer_active_orders();
								break;
			case 'noactive' :	$pagevar['title'] .= 'Не в работе';
								$pagevar['orders'] = $this->unionmodel->read_customer_noactive_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->unionmodel->count_customer_noactive_orders();
								break;
			case 'deactive' :	$pagevar['title'] .= 'Закрытые заказы';
								$pagevar['orders'] = $this->unionmodel->read_customer_deactive_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->unionmodel->count_customer_deactive_orders();
								break;
			case 'noclosed' :	$pagevar['title'] .= 'Не активные заказы';
								$pagevar['orders'] = $this->unionmodel->read_customer_noclosed_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->unionmodel->count_customer_noclosed_orders();
								break;
			case 'unpaid' :		$pagevar['title'] .= 'Неоплачанные заказы';
								$pagevar['orders'] = $this->unionmodel->read_customer_orders($field,$sortby,0,5,$from);
								$pagevar['count'] = $this->unionmodel->count_customer_orders(0);
								break;
			case 'sponsored' :	$pagevar['title'] .= 'Оплачанные заказы';
								$pagevar['orders'] = $this->unionmodel->read_customer_orders($field,$sortby,1,5,$from);
								$pagevar['count'] = $this->unionmodel->count_customer_orders(1);
								break;
			default :	$pagevar['title'] .= 'Все заказы';
						$pagevar['orders'] = $this->unionmodel->read_customer_all_orders($field,$sortby,5,$from);
						$pagevar['count'] = $this->unionmodel->count_customer_all_orders();
						break;
		endswitch;
		if($this->uri->total_segments() >= 6):
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/orders/'.$this->uri->segment(4).'/'.$field.'/'.$sortby;
			$config['uri_segment']	= 7;
		else:
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/orders/'.$this->uri->segment(4);
			$config['uri_segment'] 	= 5;
		endif;
		$config['total_rows'] 		= $pagevar['count']; 
		$config['per_page'] 		= 5;
		$config['num_links'] 		= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		if($this->input->post('dsubmit')):
			$_POST['dsubmit'] = NULL;
			$this->form_validation->set_rules('order',' ','required|trim');
			$this->form_validation->set_rules('discount',' ','trim');
			$this->form_validation->set_rules('paiddoc',' ','trim');
			$this->form_validation->set_rules('paiddate',' ','trim');
			$this->form_validation->set_rules('numberplacement',' ','trim');
			$this->form_validation->set_rules('numbercompletion',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				$this->ordersmodel->update_field($_POST['order'],'discount',$_POST['discount']);
				$this->ordersmodel->update_field($_POST['order'],'docnumber',$_POST['paiddoc']);
				$this->ordersmodel->update_field($_POST['order'],'numberplacement',$_POST['numberplacement']);
				$this->ordersmodel->update_field($_POST['order'],'numbercompletion',$_POST['numbercompletion']);
				if(isset($_POST['paiddate'])):
					if(($_POST['paiddate'] != "Не оплачен") &&  $_POST['paiddate']!= '0000-00-00' && !empty($_POST['paiddate'])):
						$arrdate = preg_split('/[\s, \-\\;\|\/]+/',$_POST['paiddate'],-1,PREG_SPLIT_NO_EMPTY);
						for($i=0;$i<count($arrdate);$i++):
							$oDate = new DateTime($arrdate[$i]);
							$sDate[$i] = $oDate->format("Y-m-d");
							unset($oDate);
						endfor;
						$_POST['paiddate'] = implode(' , ',$sDate);
						$this->ordersmodel->update_field($_POST['order'],'userpaiddate',$_POST['paiddate']);
					else:
						$this->ordersmodel->update_field($_POST['order'],'userpaiddate','');
					endif;
				endif;
				$this->session->set_userdata('msgs','Информация по заказу успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
			$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				if($pagevar['orders'][$i]['closedate'] > date("Y-m-d")):
					$pagevar['orders'][$i]['closedate'] = '<span class="green">'.$pagevar['orders'][$i]['closedate'].'</span>';
				elseif(empty($pagevar['orders'][$i]['numbercompletion']) && $pagevar['orders'][$i]['closedate'] != '0000-00-00'):
					$pagevar['orders'][$i]['closedate'] = '<span class="red">'.$pagevar['orders'][$i]['closedate'].'</span>';
				endif;
			endif;
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				$pagevar['orders'][$i]['closedate'] = $this->operation_dot_date($pagevar['orders'][$i]['closedate']);
			endif;
			$date = $pagevar['orders'][$i]['userpaiddate'];
			if(($date != "Не оплачен") &&  $date!= '0000-00-00' && !empty($date)):
				$arrdate = preg_split('/[\s, ]+/',$pagevar['orders'][$i]['userpaiddate'],-1,PREG_SPLIT_NO_EMPTY);
				for($j=0;$j<count($arrdate);$j++):
					$oDate = new DateTime($arrdate[$j]);
					$sDate[$j] = $oDate->format("d.m.Y");
					unset($oDate);
				endfor;
				$pagevar['orders'][$i]['userpaiddate'] = implode(' , ',$sDate);
				unset($sDate);
			endif;
			$pagevar['orders'][$i]['audcnt'] = count($this->unionmodel->read_fullinfo_audience($pagevar['orders'][$i]['id']));
			$pagevar['orders'][$i]['regnum'] = $this->ordersmodel->read_field($pagevar['orders'][$i]['id'],'numbercompletion');
			if($pagevar['orders'][$i]['regnum']):
				$pagevar['orders'][$i]['regnum'] = preg_replace("([^0-9])","",$pagevar['orders'][$i]['regnum']);
			else:
				$pagevar['orders'][$i]['regnum'] = 'Не завершен';
			endif;
			if(!$pagevar['orders'][$i]['audcnt']):
				$pagevar['orders'][$i]['audcnt'] = 0;
			endif;
		endfor;
		$this->load->view("admin_interface/admin-orders",$pagevar);
	}
	
	public function deleted_orders(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Удаленные заказы',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> array(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'count'			=> 0,
					'pages'			=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$from = intval($this->uri->segment(5));
		if($this->uri->total_segments() >= 6):
			$field = $this->uri->segment(5);
			$sortby = $this->uri->segment(6);
			$from = intval($this->uri->segment(7));
			$fvalue = array('','id','paiddate','closedate','organization','userpaiddate');
			if(!array_search($field,$fvalue)):
				show_404();
			endif;
			$svalue = array('','desc','asc');
			if(!array_search($sortby,$svalue,true)):
				show_404();
			endif;
		endif;
		if(empty($sortby) || empty($field)):
			$sortby = 'desc';
			$field = 'id';
		endif;
		$pagevar['orders'] 			= $this->unionmodel->read_deleted_orders($field,$sortby,5,$from);
		$pagevar['count'] 			= $this->unionmodel->count_deleted_orders();
		
		if($this->uri->total_segments() >= 6):
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/deleted/orders/'.$field.'/'.$sortby;
			$config['uri_segment']	= 7;
		else:
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/deleted/orders/';
			$config['uri_segment'] 	= 5;
		endif;
		
		$config['total_rows'] 		= $pagevar['count']; 
		$config['per_page'] 		= 5;
		$config['num_links'] 		= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
			$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				if($pagevar['orders'][$i]['closedate'] > date("Y-m-d")):
					$pagevar['orders'][$i]['closedate'] = '<span class="green">'.$pagevar['orders'][$i]['closedate'].'</span>';
				elseif(empty($pagevar['orders'][$i]['numbercompletion']) && $pagevar['orders'][$i]['closedate'] != '0000-00-00'):
					$pagevar['orders'][$i]['closedate'] = '<span class="red">'.$pagevar['orders'][$i]['closedate'].'</span>';
				endif;
			endif;
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				$pagevar['orders'][$i]['closedate'] = $this->operation_dot_date($pagevar['orders'][$i]['closedate']);
			endif;
			$date = $pagevar['orders'][$i]['userpaiddate'];
			if(($date != "Не оплачен") &&  $date!= '0000-00-00' && !empty($date)):
				$arrdate = preg_split('/[\s, ]+/',$pagevar['orders'][$i]['userpaiddate'],-1,PREG_SPLIT_NO_EMPTY);
				for($j=0;$j<count($arrdate);$j++):
					$oDate = new DateTime($arrdate[$j]);
					$sDate[$j] = $oDate->format("d.m.Y");
					unset($oDate);
				endfor;
				$pagevar['orders'][$i]['userpaiddate'] = implode(' , ',$sDate);
				unset($sDate);
			endif;
			$pagevar['orders'][$i]['audcnt'] = count($this->unionmodel->read_fullinfo_audience($pagevar['orders'][$i]['id']));
			$pagevar['orders'][$i]['regnum'] = $this->ordersmodel->read_field($pagevar['orders'][$i]['id'],'numbercompletion');
			if($pagevar['orders'][$i]['regnum']):
				$pagevar['orders'][$i]['regnum'] = preg_replace("([^0-9])","",$pagevar['orders'][$i]['regnum']);
			else:
				$pagevar['orders'][$i]['regnum'] = 'Не завершен';
			endif;
			if(!$pagevar['orders'][$i]['audcnt']):
				$pagevar['orders'][$i]['audcnt'] = 0;
			endif;
		endfor;
		$this->load->view("admin_interface/deleted-orders",$pagevar);
	}
	
	public function orders_search(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Поиск заказа',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> array(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->uri->total_segments() == 5):
			$sessiondata = array('srhorder'=>'','nborder'=>'','customer'=>'','nbpaiddoc'=>'','nbadmission'=>'','nbcompletion'=>'');
			$this->session->unset_userdata($sessiondata);
			redirect('admin-panel/messages/search/orders');
		endif;
		
		$srcorder = $this->session->userdata('srhorder');
		if($srcorder):
			$sessdata = $this->session->all_userdata();
			$pagevar['orders'] = $this->unionmodel->read_customer_search_orders($sessdata['nborder'],$sessdata['customer'],$sessdata['nbpaiddoc'],$sessdata['nbadmission'],$sessdata['nbcompletion']);
			if(!count($pagevar['orders'])):
				$this->session->set_userdata('msgr','Заказов не найдено.');
				$this->session->set_userdata('srhorder',FALSE);
				redirect('admin-panel/messages/search/orders');
			endif;
			for($i=0;$i<count($pagevar['orders']);$i++):
				$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
				$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
				if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
					$pagevar['orders'][$i]['closedate'] = $this->operation_dot_date($pagevar['orders'][$i]['closedate']);
				endif;
				$date = $pagevar['orders'][$i]['userpaiddate'];
				if(($date != "Не оплачен") &&  $date!= '0000-00-00' && !empty($date)):
					$arrdate = preg_split('/[\s, ]+/',$pagevar['orders'][$i]['userpaiddate'],-1,PREG_SPLIT_NO_EMPTY);
					for($j=0;$j<count($arrdate);$j++):
						$oDate = new DateTime($arrdate[$j]);
						$sDate[$j] = $oDate->format("d.m.Y");
						unset($oDate);
					endfor;
					$pagevar['orders'][$i]['userpaiddate'] = implode(' , ',$sDate);
					unset($sDate);
				endif;
				$pagevar['orders'][$i]['audcnt'] = count($this->unionmodel->read_fullinfo_audience($pagevar['orders'][$i]['id']));
				if(!$pagevar['orders'][$i]['audcnt']):
					$pagevar['orders'][$i]['audcnt'] = 0;
				endif;
				$pagevar['orders'][$i]['regnum'] = $this->ordersmodel->read_field($pagevar['orders'][$i]['id'],'numbercompletion');
				if($pagevar['orders'][$i]['regnum']):
					$pagevar['orders'][$i]['regnum'] = preg_replace("([^0-9])","",$pagevar['orders'][$i]['regnum']);
				else:
					$pagevar['orders'][$i]['regnum'] = 'Не завершен';
				endif;
			endfor;
		endif;
		if($this->input->post('dsubmit')):
			$_POST['dsubmit'] = NULL;
			$this->form_validation->set_rules('order',' ','required|trim');
			$this->form_validation->set_rules('discount',' ','trim');
			$this->form_validation->set_rules('paiddoc',' ','trim');
			$this->form_validation->set_rules('paiddate',' ','trim');
			$this->form_validation->set_rules('numberplacement',' ','trim');
			$this->form_validation->set_rules('numbercompletion',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				$this->ordersmodel->update_field($_POST['order'],'discount',$_POST['discount']);
				$this->ordersmodel->update_field($_POST['order'],'docnumber',$_POST['paiddoc']);
				$this->ordersmodel->update_field($_POST['order'],'numberplacement',$_POST['numberplacement']);
				$this->ordersmodel->update_field($_POST['order'],'numbercompletion',$_POST['numbercompletion']);
				if(isset($_POST['paiddate'])):
					$this->ordersmodel->update_field($_POST['order'],'userpaiddate',$_POST['paiddate']);
				endif;
				$this->session->set_userdata('msgs','Информация по заказу успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('nborder',' ','trim');
			$this->form_validation->set_rules('customer',' ','trim');
			$this->form_validation->set_rules('nbpaiddoc',' ','trim');
			$this->form_validation->set_rules('nbadmission',' ','trim');
			$this->form_validation->set_rules('nbcompletion',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при поиске.');
			else:
				$sessiondata = array('srhorder'=>TRUE,'nborder'=>$_POST['nborder'],'customer'=>$_POST['customer'],'nbpaiddoc'=>$_POST['nbpaiddoc'],'nbadmission'=>$_POST['nbadmission'],'nbcompletion'=>$_POST['nbcompletion']);
				$this->session->set_userdata($sessiondata);
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-orders-search",$pagevar);
	}
	
	public function search_customer(){
		
		$statusval = array('status'=>FALSE,'retvalue'=>'');
		$search = $this->input->post('squery');
		if(!$search) show_404();
		$customers = $this->customersmodel->search_customers(htmlspecialchars($search));
		if($customers):
			$statusval['retvalue'] = '<ul>';
			for($i=0;$i<count($customers);$i++):
				$customers[$i]['organization'] = htmlspecialchars_decode($customers[$i]['organization']);
				$statusval['retvalue'] .= '<li class="custorg" data-cusid="'.$customers[$i]['id'].'">'.$customers[$i]['organization'].'</li>';
			endfor;
			$statusval['retvalue'] .= '</ul>';
			$statusval['status'] = TRUE;
		endif;
		echo json_encode($statusval);
	}
	
	public function search_physical(){
		
		$statusval = array('status'=>FALSE,'retvalue'=>'');
		$search = $this->input->post('squery');
		if(!$search) show_404();
		$customers = $this->physicalmodel->search_physical(htmlspecialchars($search));
		if($customers):
			$statusval['retvalue'] = '<ul>';
			for($i=0;$i<count($customers);$i++):
				$customers[$i]['organization'] = $customers[$i]['fio'];
				$statusval['retvalue'] .= '<li class="custorg" data-cusid="'.$customers[$i]['id'].'">'.$customers[$i]['organization'].'</li>';
			endfor;
			$statusval['retvalue'] .= '</ul>';
			$statusval['status'] = TRUE;
		endif;
		echo json_encode($statusval);
	}
	
	public function search_audience(){
		
		$statusval = array('status'=>FALSE,'retvalue'=>'');
		$search = $this->input->post('squery');
		if(!$search) show_404();
		$audience = $this->audiencemodel->search_audience(htmlspecialchars($search));
		if($audience):
			$statusval['retvalue'] = '<ul>';
			for($i=0;$i<count($audience);$i++):
				$audience[$i]['name'] = $audience[$i]['lastname'].' '.$audience[$i]['name'].' '.$audience[$i]['middlename'];
				$statusval['retvalue'] .= '<li class="sluorg" data-sluid="'.$audience[$i]['id'].'">'.$audience[$i]['name'].'</li>';
			endfor;
			$statusval['retvalue'] .= '</ul>';
			$statusval['status'] = TRUE;
		endif;
		echo json_encode($statusval);
	}
	
	public function orders_paid(){
	
		$order = $this->input->post('order');
		if(!$order) show_404();
		$access = $this->input->post('access');
		if(!$access) $access = 0;
		$this->ordersmodel->paid_order($order,$access);
		if($access):
			$next_numbers = $this->ordersmodel->next_numbers();
			if(!$next_numbers['completion']):
				$next_numbers['completion'] = 1;
			endif;
			if(!$next_numbers['placement']):
				$next_numbers['placement'] = 1;
			endif;
			$this->ordersmodel->update_field($order,'numberplacement',$next_numbers['placement'].'-З');
			/******************************************************/
			$tmpdate = $this->calendarmodel->read_date();
			for($i=0;$i<count($tmpdate);$i++):
				$seldate[$i] = $tmpdate[$i]['date'];
			endfor;
			array_unshift($seldate,'1111-11-11');
			unset($tmpdate);
			$courses = $this->unionmodel->read_course_audience_records($order);
			$days = round($courses[0]['chours']/8);
			$kday = $i = 0; $overdate = '';
			while($kday < $days):
				$curdate = date("Y-m-d",mktime(0,0,0,date('m'),date('d')+$i,date('Y')));
				$holiday = date("w",mktime(0,0,0,date('m'),date('d')+$i,date('Y')));
				if(!array_search($curdate,$seldate) && ($holiday != 0)):
					$overdate = $curdate;
					$kday++;
				endif;
				$i++;
			endwhile;
			$this->ordersmodel->update_field($order,'closedate',$overdate);
			/******************************************************/
		else:
			$this->ordersmodel->update_field($order,'numberplacement','');
			$this->ordersmodel->update_field($order,'closedate','0000-00-00');
		endif;
	}
	
	public function orders_send_mail(){
		
		$statusval = array('retvalue'=>'<i class="icon-ok" title="Отправлено"></i>','retemail'=>'');
		$order = $this->input->post('order');
		$smtype = $this->input->post('smtype');
		$info = $this->unionmodel->read_customer_info_order($order);
		$info['orderdate'] = $this->operation_dot_date($info['orderdate']);
		$info['closedate'] = $this->operation_dot_date($info['closedate']);
		ob_start();
		?>
			<p>Здравствуйте, <?=$info['organization'];?></p>
		<?php
		if($smtype == 'smtext'):
			?>
			<p>Администрация АНО ДПО «Южно-окружной центр повышения квалификации» <a href="http://roscentrdpo.ru/ ">http://roscentrdpo.ru/ </a> извещает 
				о невозможности оформления документов (удостоверений, актов выполненных работ) согласно договора 
				№<u>&nbsp;&nbsp;&nbsp;<?=$order;?>&nbsp;&nbsp;&nbsp;</u> от <u>&nbsp;&nbsp;&nbsp;<?=$info['orderdate'];?>&nbsp;&nbsp;&nbsp;</u>
				о повышении квалификации сотрудников Вашей организации по причине отсутствия результатов итогового тестирования обучающихся.<br/>
				Убедительно просим  срочно обеспечить проведение итогового тестирования (аттестацию) Ваших сотрудников.</p>
			<?php
		else:
			?>
			<p>
				Система дистанционного обучения АНО ДПО «Южно-окружной центр повышения квалификации» <a href="http://roscentrdpo.ru/">http://roscentrdpo.ru/</a> 
				сообщает о зачислении Вашего платежа.
			</p>
			<p>
				Форма оплаты: Безналичная <br />
				Способ оплаты: Оплата квитанцией <br />
				Назначение платежа: Оплата заказа №<u>&nbsp;&nbsp;&nbsp;<?=$order;?>&nbsp;&nbsp;&nbsp;</u> <br/>
				Сумма платежа: <u>&nbsp;&nbsp;&nbsp;<?=$info['price'];?>&nbsp;&nbsp;&nbsp;</u> руб. <br />
				Документ платежа:  Платежное поручение №<u>&nbsp;&nbsp;&nbsp;<?=$info['docnumber'];?>&nbsp;&nbsp;&nbsp;</u> от <u>&nbsp;&nbsp;&nbsp;<?=$info['userpaiddate'];?>&nbsp;&nbsp;&nbsp;</u>
			</p>
			<p>
				Ваш платеж распределен следующим образом
			</p>
			<table border="0">
				<thead>
					<tr>
						<th>Назначение платежа</th>
						<th>Сумма, руб.</th>
					</tr>
				</thead>
				<tbody>
					<td>Оплата заказа №<u>&nbsp;&nbsp;&nbsp;<?=$order;?>&nbsp;&nbsp;&nbsp;</u> от <u>&nbsp;&nbsp;&nbsp;<?=$info['orderdate'];?>&nbsp;&nbsp;&nbsp;</u>, план оплаты: "Весь период обучения"</td>
					<td><u>&nbsp;&nbsp;&nbsp;<?=$info['price'];?>&nbsp;&nbsp;&nbsp;</u>,00</td>
				</tbody>
			</table>
			<p>
				<em><strong>Прохождение итогового тестирования станет доступно с <?=$info['closedate'];?></strong></em><br/>
				<strong>ВНИМАНИЕ!</strong> В случае возникновения каких-либо вопросов относительно данных платежа обращайтесь по тел.: 2-36-53-53
			</p>
		<?php
		endif;
		?>
			<br/><br/>
			<p>
				Наш адрес: г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
				Контактные данные: Тел.:(863) 246-43-54 Эл.почта: info@roscentrdpo.ru<br/>
				С уважением, Администрация Образовательного портала АНО ДПО «Южно-окружной центр повышения квалификации»
			</p>
		<?php
		$mailtext = ob_get_clean();
		
		$this->email->clear(TRUE);
		$config['smtp_host'] = 'localhost';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		
		$this->email->initialize($config);
		$this->email->to($info['personemail']);
		$this->email->from('admin@roscentrdpo.ru','АНО ДПО');
		$this->email->bcc('');
		$this->email->subject('Уведомление о оплате за обучение');
		$this->email->message($mailtext);	
		$this->email->send();
		
		$statusval['retemail'] = $info['personemail'];
		echo json_encode($statusval);
	}
	
	public function order_delete(){
		
		$order = $this->uri->segment(5);
		$this->ordersmodel->update_field($order,'deleted',1);
		$this->session->set_userdata('msgs','Заказ перемещен.');
		/*if(!$this->ordersmodel->valid_finish($order)):
			$this->session->set_userdata('msgs','Заказ удален.');
			$this->audienceordermodel->delete_order_records($order);
			$this->courseordermodel->delete_order($order);
			$this->ordersmodel->delete_record($order);
			$maxrecid = $this->ordersmodel->last_id();
			$this->ordersmodel->set_autoincrement($maxrecid+1);
		endif;*/
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function order_restore(){
		
		$order = $this->uri->segment(5);
		$this->ordersmodel->update_field($order,'deleted',0);
		$this->session->set_userdata('msgs','Заказ восстановлен.');
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	/********************************************************* testing ********************************************************/
	
	public function orders_testing(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Итоговые тесты',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'audcourses'	=> $this->unionmodel->read_testing_order($this->uri->segment(5)),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['audcourses']);$i++):
			if($pagevar['audcourses'][$i]['status']):
				$pagevar['audcourses'][$i]['dateover'] = $this->operation_dot_date($pagevar['audcourses'][$i]['dateover']);
			else:
				$pagevar['audcourses'][$i]['dateover'] = 'не пройден';
			endif;
		endfor;
		$this->load->view("admin_interface/admin-orders-testing",$pagevar);
	}
	
	public function test_report_full(){
	
		$reptest = $this->uri->segment(10);
		$course = $this->uri->segment(8);
		$audience = $this->uri->segment(6);
		$order = $this->uri->segment(4);
		if(!$this->audienceordermodel->read_status($course)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/orders/id/'.$order.'/testing');
		endif;
		
		if(!$this->testresultsmodel->owner_report($course,$reptest)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/orders/id/'.$order.'/testing');
		endif;
		
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Отчет о итоговом тестировании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'report'		=> $this->testresultsmodel->read_record($reptest),
					'audience'		=> $this->audiencemodel->read_full_name($audience),
					'test'			=> array(),
					'questions'		=> array(),
					'answers'		=> array()
			);
		
		$pagevar['report']['dataresult'] = unserialize($pagevar['report']['dataresult']);
		$pagevar['test'] = $this->unionmodel->read_audience_testing($pagevar['report']['test'],$audience,$pagevar['report']['course']);
		$pagevar['questions'] = $this->testquestionsmodel->read_records($pagevar['test']['tid']);
		$pagevar['answers'] = $this->testanswersmodel->read_records($pagevar['test']['tid']);
		$pagevar['test']['attemptdate'] = $this->operation_date($pagevar['test']['attemptdate']);
		$this->load->view("admin_interface/test-report",$pagevar);
	}
	
	public function test_report_short(){
	
		$reptest = $this->uri->segment(10);
		$course = $this->uri->segment(8);
		$audience = $this->uri->segment(6);
		$order = $this->uri->segment(4);
		if(!$this->audienceordermodel->read_status($course)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/orders/id/'.$order.'/testing');
		endif;
		
		if(!$this->testresultsmodel->owner_report($course,$reptest)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/orders/id/'.$order.'/testing');
		endif;
		
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Отчет о итоговом тестировании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'info'			=> $this->unionmodel->read_fullinfo_report($course,$order,$audience),
					'test'			=> array(),
					'questions'		=> array(),
					'answers'		=> array()
			);
		$pagevar['info']['dateover'] = $this->operation_date($pagevar['info']['dateover']);
		$this->load->view("admin_interface/test-report-short",$pagevar);
	}
	
	/******************************************************** documents ********************************************************/
	
	public function statement(){
		
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Ведомость итог.тестирования',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->ordersmodel->read_field($order,'paiddate'),
					'dateend'		=> $this->ordersmodel->read_field($order,'closedate'),
					'hours'			=> 0,
					'courses'		=> $this->unionmodel->read_course_audience_records($order)
			);
		/*if($pagevar['datebegin']!='Не оплачен' && !empty($pagevar['datebegin'])):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->split_dot_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;*/
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		if($pagevar['dateend'] != '0000-00-00'):
			if($pagevar['dateend'] > date("Y-m-d")):
				$pagevar['dateend'] = '0000-00-00';
			endif;
		endif;
		if($pagevar['dateend'] != "0000-00-00"):
			$pagevar['dateend'] = preg_split("/[ ]+/",$this->split_date($pagevar['dateend']));
		else:
			$pagevar['dateend'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['courses']);$i++):
			if($pagevar['courses'][$i]['status']):
				$pagevar['courses'][$i]['dateover'] = $this->operation_dot_date($pagevar['courses'][$i]['dateover']);
			else:
				$pagevar['courses'][$i]['dateover'] = 'обучение не пройдено';
			endif;
			if(!$pagevar['courses'][$i]['start']):
				$pagevar['courses'][$i]['dateover'] = 'обучение не начато';
			endif;
		endfor;
		if(isset($pagevar['courses'][0]['chours'])):
			$pagevar['hours'] = $pagevar['courses'][0]['chours'];
		endif;
		$this->load->view("admin_interface/documents/statement",$pagevar);
	}
	
	public function completion(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Приказ об окончании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->ordersmodel->read_field($order,'paiddate'),
					'dateend'		=> $this->ordersmodel->read_field($order,'closedate'),
					'hours'			=> 0,
					'ncompletion'	=> $this->ordersmodel->read_field($order,'numbercompletion'),
					'courses'		=> $this->unionmodel->read_course_audience_records($order)
			);
		/*if($pagevar['datebegin']!='Не оплачен' && !empty($pagevar['datebegin'])):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->split_dot_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;*/
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		if($pagevar['dateend'] != '0000-00-00'):
			if($pagevar['dateend'] > date("Y-m-d")):
				$pagevar['dateend'] = '0000-00-00';
			endif;
		endif;
		if($pagevar['dateend'] != "0000-00-00"):
			$pagevar['dateend'] = preg_split("/[ ]+/",$this->split_date($pagevar['dateend']));
		else:
			$pagevar['dateend'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['courses']);$i++):
			if($pagevar['courses'][$i]['status']):
				$pagevar['courses'][$i]['dateover'] = $this->operation_date($pagevar['courses'][$i]['dateover']);
			else:
				$pagevar['courses'][$i]['dateover'] = 'обучение не пройдено';
			endif;
		endfor;
		if(isset($pagevar['courses'][0]['chours'])):
			$pagevar['hours'] = $pagevar['courses'][0]['chours'];
		endif;
		$this->load->view("admin_interface/documents/completion",$pagevar);
	}
	
	public function admission(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Приказ о зачислении',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->ordersmodel->read_field($order,'paiddate'),
					'nplacement'	=> $this->ordersmodel->read_field($order,'numberplacement'),
					'courses'		=> $this->unionmodel->read_course_audience_records($order)
			);
		/*if($pagevar['datebegin']!='Не оплачен' && !empty($pagevar['datebegin'])):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->split_dot_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;*/
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['courses']);$i++):
			if($pagevar['courses'][$i]['status']):
				$pagevar['courses'][$i]['dateover'] = $this->operation_date($pagevar['courses'][$i]['dateover']);
			else:
				$pagevar['courses'][$i]['dateover'] = 'обучение не пройдено';
			endif;
		endfor;
		$this->load->view("admin_interface/documents/admission",$pagevar);
	}
	
	public function registry(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Реестр слушателей',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->ordersmodel->read_field($order,'paiddate'),
					'regdateend'	=> '',
					'dateend'		=> $this->ordersmodel->read_field($order,'closedate'),
					'hours'			=> 0,
					'ncompletion'	=> $this->ordersmodel->read_field($order,'numbercompletion'),
					'info'			=> $this->unionmodel->read_fullinfo_audience($this->uri->segment(5))
			);
		if($pagevar['ncompletion']):
			$pagevar['ncompletion'] = preg_replace("([^0-9])","",$pagevar['ncompletion']);
		endif;
		/*if($pagevar['datebegin']!='Не оплачен' && !empty($pagevar['datebegin'])):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->split_dot_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;*/
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		if($pagevar['dateend'] != '0000-00-00'):
			if($pagevar['dateend'] > date("Y-m-d")):
				$pagevar['dateend'] = '0000-00-00';
			endif;
		endif;
		if($pagevar['dateend'] != "0000-00-00"):
			$pagevar['regdateend'] = $this->operation_dot_date($pagevar['dateend']);
			$pagevar['dateend'] = preg_split("/[ ]+/",$this->split_date($pagevar['dateend']));
		else:
			$pagevar['regdateend'] = 'Не завершено';
			$pagevar['dateend'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['info']);$i++):
			if($pagevar['info'][$i]['status']):
				$pagevar['info'][$i]['dateover'] = $this->operation_dot_date($pagevar['info'][$i]['dateover']);
			else:
				$pagevar['info'][$i]['dateover'] = '---';
			endif;
			$pagevar['info'][$i]['orderdate'] = $this->operation_dot_date($pagevar['info'][$i]['orderdate']);
			if($pagevar['info'][$i]['paid']):
				$pagevar['info'][$i]['paiddate'] = $this->operation_dot_date($pagevar['info'][$i]['paiddate']);
			else:
				$pagevar['info'][$i]['paiddate'] = '---';
			endif;
				$pagevar['info'][$i]['userpaiddate'] = $this->operation_dot_date($pagevar['info'][$i]['userpaiddate']);
		endfor;
		if(isset($pagevar['courses'][0]['chours'])):
			$pagevar['hours'] = $pagevar['courses'][0]['chours'];
		endif;
		switch ($this->uri->segment(7)):
			case 'list-1': $this->load->view("admin_interface/documents/registry-list-1",$pagevar); break;
			case 'list-2': $this->load->view("admin_interface/documents/registry-list-2",$pagevar); break;
		endswitch;
	}
	
	public function reference(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Справка',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->ordersmodel->read_field($order,'paiddate'),
					'customer'		=> $this->unionmodel->read_customer_info_order($order),
					'courses'		=> $this->unionmodel->read_course_audience_records($order)
			);
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		$this->load->view("admin_interface/documents/reference",$pagevar);
	}
	
	public function invoice(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'order'			=> $this->ordersmodel->read_record($this->uri->segment(5)),
					'course'		=> $this->unionmodel->read_corder_group_records($this->uri->segment(5)),
					'customer'		=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'Счет на оплату № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->customersmodel->read_record($pagevar['order']['customer']);
		$this->load->view("customer_interface/customer-order-invoice",$pagevar);
	}
	
	public function contract(){
		
		$this->uri->segment(6);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'customer'		=> array(),
					'order'			=> $this->ordersmodel->read_record($this->uri->segment(5)),
					'course'		=> $this->unionmodel->read_corder_group_records($this->uri->segment(5)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'Договор № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->customersmodel->read_record($pagevar['order']['customer']);
		
		$this->load->view("customer_interface/customer-order-contract",$pagevar);
	}
	
	public function act(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'customer'		=> array(),
					'order'			=> $this->ordersmodel->read_record($this->uri->segment(5)),
					'course'		=> $this->unionmodel->read_corder_group_records($this->uri->segment(5)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'АКТ об оказании услуг по договору № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		if($pagevar['order']['closedate'] != "0000-00-00"):
			$pagevar['order']['closedate'] = $this->operation_date($pagevar['order']['closedate']);
		else:
			$pagevar['order']['closedate'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		$pagevar['customer'] = $this->customersmodel->read_record($pagevar['order']['customer']);
		
		$this->load->view("customer_interface/customer-order-act",$pagevar);
	}
	
	/******************************************************** users ***********************************************************/
	
	public function users_customer(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Заказчики',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'customers'		=> $this->customersmodel->read_records_pages(10,$from),
					'count'			=> count($this->customersmodel->read_records()),
					'pages'			=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['customers']);$i++):
			$pagevar['customers'][$i]['cryptpassword'] = $this->encrypt->decode($pagevar['customers'][$i]['cryptpassword']);
		endfor;
		$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/users/customer/from/';
		$config['uri_segment']	= 5;
		$config['total_rows'] 	= $pagevar['count']; 
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		if($this->input->post('ssrzak')):
			$_POST['ssrzak'] = NULL;
			$this->form_validation->set_rules('srzakid',' ','required|trim');
			$this->form_validation->set_rules('srzak',' ','required|trim');
			if(!$this->form_validation->run()):
				redirect($this->uri->uri_string());
			else:
				$pagevar['customers'] = $this->customersmodel->search_record($_POST['srzakid']);
				for($i=0;$i<count($pagevar['customers']);$i++):
					$pagevar['customers'][$i]['cryptpassword'] = $this->encrypt->decode($pagevar['customers'][$i]['cryptpassword']);
				endfor;
				$pagevar['pages'] = NULL;
			endif;
		endif;
		$this->load->view("admin_interface/admin-users-customer",$pagevar);
	}
	
	public function users_customer_info(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Заказчики - Информация',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'readonly'		=> FALSE,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'customer'		=> $this->customersmodel->read_record($this->uri->segment(6)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('organization',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('kpp',' ','required|trim');
			$this->form_validation->set_rules('accounttype',' ','required|trim');
			$this->form_validation->set_rules('accountnumber',' ','required|trim');
			$this->form_validation->set_rules('bank',' ','required|trim');
			$this->form_validation->set_rules('accountkornumber',' ','required|trim');
			$this->form_validation->set_rules('bik',' ','required|trim');
			$this->form_validation->set_rules('uraddress',' ','required|trim');
			$this->form_validation->set_rules('postaddress',' ','required|trim');
			$this->form_validation->set_rules('personemail',' ','required|valid_email|trim');
			$this->form_validation->set_rules('person',' ','required|trim');
			$this->form_validation->set_rules('manager',' ','required|trim');
			$this->form_validation->set_rules('fiomanager',' ','required|trim');
			$this->form_validation->set_rules('statutory',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
			else:
				$this->customersmodel->update_record($this->uri->segment(6),$_POST);
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-users-customer-info",$pagevar);
	}
	
	public function users_audience_info(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Заказчики - Информация',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'customer'		=> '',
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'audience'		=> $this->audiencemodel->read_record($this->uri->segment(6)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$pagevar['customer'] = $this->customersmodel->read_field($pagevar['audience']['customer'],'organization');
		$pagevar['audience']['signupdate'] = $this->operation_date($pagevar['audience']['signupdate']);
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('lastname',' ','required|trim');
			$this->form_validation->set_rules('name',' ','required|trim');
			$this->form_validation->set_rules('middlename',' ','required|trim');
			$this->form_validation->set_rules('fiodat',' ','required|trim');
			$this->form_validation->set_rules('position',' ','required|trim');
			$this->form_validation->set_rules('address',' ','required|trim');
			$this->form_validation->set_rules('personaemail',' ','required|trim');
			$this->form_validation->set_rules('personaphone',' ','required|trim');
			$this->form_validation->set_rules('graduated',' ','required|trim');
			$this->form_validation->set_rules('year',' ','required|trim');
			$this->form_validation->set_rules('documentnumber',' ','required|trim');
			$this->form_validation->set_rules('specialty',' ','required|trim');
			$this->form_validation->set_rules('qualification',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
			else:
				$this->audiencemodel->update_record($this->uri->segment(6),$this->input->post());
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-users-audience-info",$pagevar);
	}
	
	public function users_customer_load_courses(){
		
		$customer = $this->input->post('customer');
		if(!$customer) show_404();
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> $this->ordersmodel->read_customer_record($customer),
			);
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
			$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
		endfor;
		$this->load->view("admin_interface/admin-customer-load-courses",$pagevar);	
	}
	
	public function customer_access(){
		
		$customer = $this->input->post('customer');
		if(!$customer) show_404();
		$access = $this->input->post('access');
		if(!$access) $access = 0;
		$this->customersmodel->set_access($customer,$access);
	}
	
	public function delete_customer(){
		
		$customer = $this->uri->segment(5);
		if($customer):
			$result = $this->customersmodel->delete_record($customer);
			if($result):
				$this->audiencemodel->delete_records($customer);
				$this->audienceordermodel->delete_customer_records($customer);
				$this->audiencetestmodel->delete_customer_records($customer);
				$this->courseordermodel->delete_customer_records($customer);
				$this->ordersmodel->delete_customer_records($customer);
				$this->session->set_userdata('msgs','Заказчик удален успешно.');
			else:
				$this->session->set_userdata('msgr','Заказчик не удален.');
			endif;
			redirect('admin-panel/users/customer');
		else:
			show_404();
		endif;
	}
	
	public function users_audience(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Слушатели',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'audience'		=> $this->unionmodel->read_audience_pages(10,$from),
					'count'			=> count($this->unionmodel->read_audience()),
					'pages'			=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['audience']);$i++):
			$pagevar['audience'][$i]['cryptpassword'] = $this->encrypt->decode($pagevar['audience'][$i]['cryptpassword']);
		endfor;
		
		$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/users/audience/from/';
		$config['uri_segment']	= 5;
		$config['total_rows'] 	= $pagevar['count']; 
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		if($this->input->post('ssrslu')):
			$_POST['ssrslu'] = NULL;
			$this->form_validation->set_rules('srsluid',' ','required|trim');
			$this->form_validation->set_rules('srslu',' ','required|trim');
			if(!$this->form_validation->run()):
				redirect($this->uri->uri_string());
			else:
				$pagevar['audience'] = $this->unionmodel->search_audience_record($_POST['srsluid']);
				for($i=0;$i<count($pagevar['audience']);$i++):
					$pagevar['audience'][$i]['cryptpassword'] = $this->encrypt->decode($pagevar['audience'][$i]['cryptpassword']);
				endfor;
				$pagevar['pages'] = NULL;
			endif;
		endif;
		
		$this->load->view("admin_interface/admin-users-audience",$pagevar);
	}
	
	public function audience_access(){
		
		$audience = $this->input->post('audience');
		if(!$audience) show_404();
		$access = $this->input->post('access');
		if(!$access) $access = 0;
		$this->audiencemodel->set_access($audience,$access);
	}
	
	public function delete_audience(){
		
		$audience = $this->uri->segment(5);
		if($audience):
			$result = $this->audiencemodel->delete_record($audience);
			if($result):
				$this->session->set_userdata('msgs','Слушатель удален успешно.');
			else:
				$this->session->set_userdata('msgr','Слушатель не удален.');
			endif;
			redirect('admin-panel/users/audience');
		else:
			show_404();
		endif;
	}
	
	/*************************************************** users physical*****************************************************/
	
	public function users_physical(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Заказчики',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'customers'		=> $this->physicalmodel->read_records_pages(10,$from),
					'count'			=> count($this->physicalmodel->read_records()),
					'pages'			=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['customers']);$i++):
			$pagevar['customers'][$i]['cryptpassword'] = $this->encrypt->decode($pagevar['customers'][$i]['cryptpassword']);
		endfor;
		$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/users/physical/from/';
		$config['uri_segment']	= 5;
		$config['total_rows'] 	= $pagevar['count']; 
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		if($this->input->post('ssrzak')):
			$_POST['ssrzak'] = NULL;
			$this->form_validation->set_rules('srzakid',' ','required|trim');
			$this->form_validation->set_rules('srzak',' ','required|trim');
			if(!$this->form_validation->run()):
				redirect($this->uri->uri_string());
			else:
				$pagevar['customers'] = $this->physicalmodel->search_record($_POST['srzakid']);
				for($i=0;$i<count($pagevar['customers']);$i++):
					$pagevar['customers'][$i]['cryptpassword'] = $this->encrypt->decode($pagevar['customers'][$i]['cryptpassword']);
				endfor;
				$pagevar['pages'] = NULL;
			endif;
		endif;
		$this->load->view("admin_interface/physical/physical-list",$pagevar);
	}
	
	public function users_physical_info(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Заказчики - Информация',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'readonly'		=> FALSE,
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'physical'		=> $this->physicalmodel->read_record($this->uri->segment(6)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('fio',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('phones',' ','required|trim');
			$this->form_validation->set_rules('postaddress',' ','required|trim');
			$this->form_validation->set_rules('email',' ','required|valid_email|trim');
			$this->form_validation->set_rules('passport',' ','required|trim');
			$this->form_validation->set_rules('issued',' ','required|trim');
			$this->form_validation->set_rules('propiska',' ','required|trim');
			$this->form_validation->set_rules('accounttype',' ','trim');
			$this->form_validation->set_rules('accountnumber',' ','trim');
			$this->form_validation->set_rules('bank',' ','trim');
			$this->form_validation->set_rules('accountkornumber',' ','trim');
			$this->form_validation->set_rules('bik',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Не заполены необходимые поля.');
				redirect($this->uri->uri_string());
			else:
				$this->physicalmodel->update_record($this->uri->segment(6),$this->input->post());
				$this->session->set_userdata('msgs','Данные сохранены.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/physical/info",$pagevar);
	}
	
	public function users_physical_load_courses(){
		
		$customer = $this->input->post('customer');
		if(!$customer) show_404();
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> $this->fizordersmodel->read_physical_record($customer),
			);
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
			$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
		endfor;
		$this->load->view("admin_interface/physical/load-courses",$pagevar);
	}
	
	public function physical_access(){
		
		$customer = $this->input->post('customer');
		if(!$customer) show_404();
		$access = $this->input->post('access');
		if(!$access) $access = 0;
		$this->physicalmodel->set_access($customer,$access);
	}
	
	public function delete_physical(){
		
		$customer = $this->uri->segment(5);
		if($customer):
			$result = $this->physicalmodel->delete_record($customer);
			if($result):
				$this->audiencemodel->delete_records($customer);
				$this->audienceordermodel->delete_customer_records($customer);
				$this->audiencetestmodel->delete_customer_records($customer);
				$this->courseordermodel->delete_customer_records($customer);
				$this->ordersmodel->delete_customer_records($customer);
				$this->session->set_userdata('msgs','Заказчик удален успешно.');
			else:
				$this->session->set_userdata('msgr','Заказчик не удален.');
			endif;
			redirect('admin-panel/users/physical');
		else:
			show_404();
		endif;
	}

	public function fiz_orders_messages(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> array(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'count'			=> 0,
					'pages'			=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$from = intval($this->uri->segment(5));
		if($this->uri->total_segments() >= 6):
			$field = $this->uri->segment(5);
			$sortby = $this->uri->segment(6);
			$from = intval($this->uri->segment(7));
			$fvalue = array('','id','paiddate','closedate','fio','userpaiddate');
			if(!array_search($field,$fvalue)):
				show_404();
			endif;
			$svalue = array('','desc','asc');
			if(!array_search($sortby,$svalue,true)):
				show_404();
			endif;
		endif;
		if(empty($sortby) || empty($field)):
			$sortby = 'desc';
			$field = 'id';
		endif;
		switch ($this->uri->segment(4)):
			case 'active' 	:	$pagevar['title'] .= 'В работе';
								$pagevar['orders'] = $this->fizunionmodel->read_physical_active_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->fizunionmodel->count_physical_active_orders();
								break;
			case 'noactive' :	$pagevar['title'] .= 'Не в работе';
								$pagevar['orders'] = $this->fizunionmodel->read_physical_noactive_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->fizunionmodel->count_physical_noactive_orders();
								break;
			case 'deactive' :	$pagevar['title'] .= 'Закрытые заказы';
								$pagevar['orders'] = $this->fizunionmodel->read_physical_deactive_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->fizunionmodel->count_physical_deactive_orders();
								break;
			case 'noclosed' :	$pagevar['title'] .= 'Не активные заказы';
								$pagevar['orders'] = $this->fizunionmodel->read_physical_noclosed_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->fizunionmodel->count_physical_noclosed_orders();
								break;
			case 'unpaid' :		$pagevar['title'] .= 'Неоплачанные заказы';
								$pagevar['orders'] = $this->fizunionmodel->read_physical_orders($field,$sortby,0,5,$from);
								$pagevar['count'] = $this->fizunionmodel->count_physical_orders(0);
								break;
			case 'sponsored' :	$pagevar['title'] .= 'Оплачанные заказы';
								$pagevar['orders'] = $this->fizunionmodel->read_physical_orders($field,$sortby,1,5,$from);
								$pagevar['count'] = $this->fizunionmodel->count_physical_orders(1);
								break;
			default :			$pagevar['title'] .= 'Все заказы';
								$pagevar['orders'] = $this->fizunionmodel->read_physical_all_orders($field,$sortby,5,$from);
								$pagevar['count'] = $this->fizunionmodel->count_physical_all_orders();
								break;
		endswitch;
		if($this->uri->total_segments() >= 6):
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/physical-orders/'.$this->uri->segment(4).'/'.$field.'/'.$sortby;
			$config['uri_segment']	= 7;
		else:
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/physical-orders/'.$this->uri->segment(4);
			$config['uri_segment'] 	= 5;
		endif;
		$config['total_rows'] 		= $pagevar['count']; 
		$config['per_page'] 		= 5;
		$config['num_links'] 		= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		if($this->input->post('dsubmit')):
			$_POST['dsubmit'] = NULL;
			$this->form_validation->set_rules('order',' ','required|trim');
			$this->form_validation->set_rules('discount',' ','trim');
			$this->form_validation->set_rules('paiddoc',' ','trim');
			$this->form_validation->set_rules('paiddate',' ','trim');
			$this->form_validation->set_rules('numberplacement',' ','trim');
			$this->form_validation->set_rules('numbercompletion',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				$this->fizordersmodel->update_field($_POST['order'],'discount',$_POST['discount']);
				$this->fizordersmodel->update_field($_POST['order'],'docnumber',$_POST['paiddoc']);
				$this->fizordersmodel->update_field($_POST['order'],'numberplacement',$_POST['numberplacement']);
				$this->fizordersmodel->update_field($_POST['order'],'numbercompletion',$_POST['numbercompletion']);
				if(isset($_POST['paiddate'])):
					if(($_POST['paiddate'] != "Не оплачен") &&  $_POST['paiddate']!= '0000-00-00' && !empty($_POST['paiddate'])):
						$arrdate = preg_split('/[\s, \-\\;\|\/]+/',$_POST['paiddate'],-1,PREG_SPLIT_NO_EMPTY);
						for($i=0;$i<count($arrdate);$i++):
							$oDate = new DateTime($arrdate[$i]);
							$sDate[$i] = $oDate->format("Y-m-d");
							unset($oDate);
						endfor;
						$_POST['paiddate'] = implode(' , ',$sDate);
						$this->fizordersmodel->update_field($_POST['order'],'userpaiddate',$_POST['paiddate']);
					else:
						$this->fizordersmodel->update_field($_POST['order'],'userpaiddate','');
					endif;
				endif;
				$this->session->set_userdata('msgs','Информация по заказу успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
			$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				if($pagevar['orders'][$i]['closedate'] > date("Y-m-d")):
					$pagevar['orders'][$i]['closedate'] = '<span class="green">'.$pagevar['orders'][$i]['closedate'].'</span>';
				elseif(empty($pagevar['orders'][$i]['numbercompletion']) && $pagevar['orders'][$i]['closedate'] != '0000-00-00'):
					$pagevar['orders'][$i]['closedate'] = '<span class="red">'.$pagevar['orders'][$i]['closedate'].'</span>';
				endif;
			endif;
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				$pagevar['orders'][$i]['closedate'] = $this->operation_dot_date($pagevar['orders'][$i]['closedate']);
			endif;
			$date = $pagevar['orders'][$i]['userpaiddate'];
			if(($date != "Не оплачен") &&  $date!= '0000-00-00' && !empty($date)):
				$arrdate = preg_split('/[\s, ]+/',$pagevar['orders'][$i]['userpaiddate'],-1,PREG_SPLIT_NO_EMPTY);
				for($j=0;$j<count($arrdate);$j++):
					$oDate = new DateTime($arrdate[$j]);
					$sDate[$j] = $oDate->format("d.m.Y");
					unset($oDate);
				endfor;
				$pagevar['orders'][$i]['userpaiddate'] = implode(' , ',$sDate);
				unset($sDate);
			endif;
			$pagevar['orders'][$i]['regnum'] = $this->fizordersmodel->read_field($pagevar['orders'][$i]['id'],'numbercompletion');
			if($pagevar['orders'][$i]['regnum']):
				$pagevar['orders'][$i]['regnum'] = preg_replace("([^0-9])","",$pagevar['orders'][$i]['regnum']);
			else:
				$pagevar['orders'][$i]['regnum'] = 'Не завершен';
			endif;
		endfor;
		$this->load->view("admin_interface/physical/orders",$pagevar);
	}
	
	public function fiz_deleted_orders(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Удаленные заказы',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> array(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'count'			=> 0,
					'pages'			=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$from = intval($this->uri->segment(5));
		if($this->uri->total_segments() >= 6):
			$field = $this->uri->segment(5);
			$sortby = $this->uri->segment(6);
			$from = intval($this->uri->segment(7));
			$fvalue = array('','id','paiddate','closedate','fio','userpaiddate');
			if(!array_search($field,$fvalue)):
				show_404();
			endif;
			$svalue = array('','desc','asc');
			if(!array_search($sortby,$svalue,true)):
				show_404();
			endif;
		endif;
		if(empty($sortby) || empty($field)):
			$sortby = 'desc';
			$field = 'id';
		endif;
		$pagevar['orders'] 			= $this->fizunionmodel->read_deleted_orders($field,$sortby,5,$from);
		$pagevar['count'] 			= $this->fizunionmodel->count_deleted_orders();
		
		if($this->uri->total_segments() >= 6):
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/deleted/physical-orders/'.$field.'/'.$sortby;
			$config['uri_segment']	= 7;
		else:
			$config['base_url'] 	= $pagevar['baseurl'].'admin-panel/messages/deleted/physical-orders/';
			$config['uri_segment'] 	= 5;
		endif;
		
		$config['total_rows'] 		= $pagevar['count']; 
		$config['per_page'] 		= 5;
		$config['num_links'] 		= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
			$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				if($pagevar['orders'][$i]['closedate'] > date("Y-m-d")):
					$pagevar['orders'][$i]['closedate'] = '<span class="green">'.$pagevar['orders'][$i]['closedate'].'</span>';
				elseif(empty($pagevar['orders'][$i]['numbercompletion']) && $pagevar['orders'][$i]['closedate'] != '0000-00-00'):
					$pagevar['orders'][$i]['closedate'] = '<span class="red">'.$pagevar['orders'][$i]['closedate'].'</span>';
				endif;
			endif;
			if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
				$pagevar['orders'][$i]['closedate'] = $this->operation_dot_date($pagevar['orders'][$i]['closedate']);
			endif;
			$date = $pagevar['orders'][$i]['userpaiddate'];
			if(($date != "Не оплачен") &&  $date!= '0000-00-00' && !empty($date)):
				$arrdate = preg_split('/[\s, ]+/',$pagevar['orders'][$i]['userpaiddate'],-1,PREG_SPLIT_NO_EMPTY);
				for($j=0;$j<count($arrdate);$j++):
					$oDate = new DateTime($arrdate[$j]);
					$sDate[$j] = $oDate->format("d.m.Y");
					unset($oDate);
				endfor;
				$pagevar['orders'][$i]['userpaiddate'] = implode(' , ',$sDate);
				unset($sDate);
			endif;
			$pagevar['orders'][$i]['regnum'] = $this->ordersmodel->read_field($pagevar['orders'][$i]['id'],'numbercompletion');
			if($pagevar['orders'][$i]['regnum']):
				$pagevar['orders'][$i]['regnum'] = preg_replace("([^0-9])","",$pagevar['orders'][$i]['regnum']);
			else:
				$pagevar['orders'][$i]['regnum'] = 'Не завершен';
			endif;
		endfor;
		$this->load->view("admin_interface/physical/deleted-orders",$pagevar);
	}
	
	public function fiz_orders_search(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Поиск заказа',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'orders'		=> array(),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->uri->total_segments() == 5):
			$sessiondata = array('srhorder'=>'','nborder'=>'','customer'=>'','nbpaiddoc'=>'','nbadmission'=>'','nbcompletion'=>'');
			$this->session->unset_userdata($sessiondata);
			redirect('admin-panel/messages/search/orders');
		endif;
		
		$srcorder = $this->session->userdata('srhorder');
		if($srcorder):
			$sessdata = $this->session->all_userdata();
			$pagevar['orders'] = $this->fizunionmodel->read_customer_search_orders($sessdata['nborder'],$sessdata['customer'],$sessdata['nbpaiddoc'],$sessdata['nbadmission'],$sessdata['nbcompletion']);
			if(!count($pagevar['orders'])):
				$this->session->set_userdata('msgr','Заказов не найдено.');
				$this->session->set_userdata('srhorder',FALSE);
				redirect('admin-panel/messages/search/orders');
			endif;
			for($i=0;$i<count($pagevar['orders']);$i++):
				$pagevar['orders'][$i]['orderdate'] = $this->operation_dot_date($pagevar['orders'][$i]['orderdate']);
				$pagevar['orders'][$i]['paiddate'] = $this->operation_dot_date($pagevar['orders'][$i]['paiddate']);
				if($pagevar['orders'][$i]['closedate'] != '0000-00-00'):
					$pagevar['orders'][$i]['closedate'] = $this->operation_dot_date($pagevar['orders'][$i]['closedate']);
				endif;
				$date = $pagevar['orders'][$i]['userpaiddate'];
				if(($date != "Не оплачен") &&  $date!= '0000-00-00' && !empty($date)):
					$arrdate = preg_split('/[\s, ]+/',$pagevar['orders'][$i]['userpaiddate'],-1,PREG_SPLIT_NO_EMPTY);
					for($j=0;$j<count($arrdate);$j++):
						$oDate = new DateTime($arrdate[$j]);
						$sDate[$j] = $oDate->format("d.m.Y");
						unset($oDate);
					endfor;
					$pagevar['orders'][$i]['userpaiddate'] = implode(' , ',$sDate);
					unset($sDate);
				endif;
				$pagevar['orders'][$i]['audcnt'] = count($this->fizunionmodel->read_fullinfo_audience($pagevar['orders'][$i]['id']));
				if(!$pagevar['orders'][$i]['audcnt']):
					$pagevar['orders'][$i]['audcnt'] = 0;
				endif;
				$pagevar['orders'][$i]['regnum'] = $this->fizordersmodel->read_field($pagevar['orders'][$i]['id'],'numbercompletion');
				if($pagevar['orders'][$i]['regnum']):
					$pagevar['orders'][$i]['regnum'] = preg_replace("([^0-9])","",$pagevar['orders'][$i]['regnum']);
				else:
					$pagevar['orders'][$i]['regnum'] = 'Не завершен';
				endif;
			endfor;
		endif;
		if($this->input->post('dsubmit')):
			$_POST['dsubmit'] = NULL;
			$this->form_validation->set_rules('order',' ','required|trim');
			$this->form_validation->set_rules('discount',' ','trim');
			$this->form_validation->set_rules('paiddoc',' ','trim');
			$this->form_validation->set_rules('paiddate',' ','trim');
			$this->form_validation->set_rules('numberplacement',' ','trim');
			$this->form_validation->set_rules('numbercompletion',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при сохранении. Не заполены необходимые поля.');
			else:
				$this->fizordersmodel->update_field($_POST['order'],'discount',$_POST['discount']);
				$this->fizordersmodel->update_field($_POST['order'],'docnumber',$_POST['paiddoc']);
				$this->fizordersmodel->update_field($_POST['order'],'numberplacement',$_POST['numberplacement']);
				$this->fizordersmodel->update_field($_POST['order'],'numbercompletion',$_POST['numbercompletion']);
				if(isset($_POST['paiddate'])):
					$this->fizordersmodel->update_field($_POST['order'],'userpaiddate',$_POST['paiddate']);
				endif;
				$this->session->set_userdata('msgs','Информация по заказу успешно сохранена.');
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		if($this->input->post('submit')):
			$_POST['submit'] = NULL;
			$this->form_validation->set_rules('nborder',' ','trim');
			$this->form_validation->set_rules('customer',' ','trim');
			$this->form_validation->set_rules('nbpaiddoc',' ','trim');
			$this->form_validation->set_rules('nbadmission',' ','trim');
			$this->form_validation->set_rules('nbcompletion',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка при поиске.');
			else:
				$sessiondata = array('srhorder'=>TRUE,'nborder'=>$_POST['nborder'],'customer'=>$_POST['customer'],'nbpaiddoc'=>$_POST['nbpaiddoc'],'nbadmission'=>$_POST['nbadmission'],'nbcompletion'=>$_POST['nbcompletion']);
				$this->session->set_userdata($sessiondata);
			endif;
			redirect($this->uri->uri_string());
		endif;
		
		$this->load->view("admin_interface/admin-orders-search",$pagevar);
	}
	
	public function fiz_orders_paid(){
	
		$order = $this->input->post('order');
		if(!$order) show_404();
		$access = $this->input->post('access');
		if(!$access) $access = 0;
		$this->fizordersmodel->paid_order($order,$access);
		if($access):
			$next_numbers = $this->fizordersmodel->next_numbers();
			if(!$next_numbers['completion']):
				$next_numbers['completion'] = 1;
			endif;
			if(!$next_numbers['placement']):
				$next_numbers['placement'] = 1;
			endif;
			$this->fizordersmodel->update_field($order,'numberplacement',$next_numbers['placement'].'-З');
			/******************************************************/
			$tmpdate = $this->calendarmodel->read_date();
			for($i=0;$i<count($tmpdate);$i++):
				$seldate[$i] = $tmpdate[$i]['date'];
			endfor;
			array_unshift($seldate,'1111-11-11');
			unset($tmpdate);
			$chours = $this->fizunionmodel->read_course_max_hours($order);
			$days = round($chours/8);
			print_r($chours);
			$kday = $i = 0; $overdate = '';
			while($kday < $days):
				$curdate = date("Y-m-d",mktime(0,0,0,date('m'),date('d')+$i,date('Y')));
				$holiday = date("w",mktime(0,0,0,date('m'),date('d')+$i,date('Y')));
				if(!array_search($curdate,$seldate) && ($holiday != 0)):
					$overdate = $curdate;
					$kday++;
				endif;
				$i++;
			endwhile;
			$this->fizordersmodel->update_field($order,'closedate',$overdate);
			/******************************************************/
		else:
			$this->fizordersmodel->update_field($order,'numberplacement','');
			$this->fizordersmodel->update_field($order,'closedate','0000-00-00');
		endif;
	}
	
	public function fiz_orders_send_mail(){
		
		$statusval = array('retvalue'=>'&nbsp;<i class="icon-ok" title="Отправлено"></i>','retemail'=>'');
		$order = $this->input->post('order');
		$smtype = $this->input->post('smtype');
		$info = $this->fizunionmodel->read_physical_info_order($order);
		$info['orderdate'] = $this->operation_dot_date($info['orderdate']);
		$info['closedate'] = $this->operation_dot_date($info['closedate']);
		ob_start();
		?>
			<p>Здравствуйте, <?=$info['fio'];?></p>
		<?php
		if($smtype == 'smtext'):
			?>
			<p>Администрация АНО ДПО «Южно-окружной центр повышения квалификации» <a href="http://roscentrdpo.ru/ ">http://roscentrdpo.ru/ </a> извещает 
				о невозможности оформления документов (удостоверений, актов выполненных работ) согласно договора 
				№<u>&nbsp;&nbsp;&nbsp;<?=$order;?>&nbsp;&nbsp;&nbsp;</u> от <u>&nbsp;&nbsp;&nbsp;<?=$info['orderdate'];?>&nbsp;&nbsp;&nbsp;</u>
				о повышении Вашей квалификации по причине отсутствия результатов итогового тестирования.<br/>
				Убедительно просим  срочно обеспечить проведение итогового тестирования (аттестацию).</p>
			<?php
		else:
			?>
			<p>
				Система дистанционного обучения АНО ДПО «Южно-окружной центр повышения квалификации» <a href="http://roscentrdpo.ru/">http://roscentrdpo.ru/</a> 
				сообщает о зачислении Вашего платежа.
			</p>
			<p>
				Форма оплаты: Безналичная <br />
				Способ оплаты: Оплата квитанцией <br />
				Назначение платежа: Оплата заказа №<u>&nbsp;&nbsp;&nbsp;<?=$order;?>&nbsp;&nbsp;&nbsp;</u> <br/>
				Сумма платежа: <u>&nbsp;&nbsp;&nbsp;<?=$info['price'];?>&nbsp;&nbsp;&nbsp;</u> руб. <br />
				Документ платежа:  Платежное поручение №<u>&nbsp;&nbsp;&nbsp;<?=$info['docnumber'];?>&nbsp;&nbsp;&nbsp;</u> от <u>&nbsp;&nbsp;&nbsp;<?=$info['userpaiddate'];?>&nbsp;&nbsp;&nbsp;</u>
			</p>
			<p>
				Ваш платеж распределен следующим образом
			</p>
			<table border="0">
				<thead>
					<tr>
						<th>Назначение платежа</th>
						<th>Сумма, руб.</th>
					</tr>
				</thead>
				<tbody>
					<td>Оплата заказа №<u>&nbsp;&nbsp;&nbsp;<?=$order;?>&nbsp;&nbsp;&nbsp;</u> от <u>&nbsp;&nbsp;&nbsp;<?=$info['orderdate'];?>&nbsp;&nbsp;&nbsp;</u>, план оплаты: "Весь период обучения"</td>
					<td><u>&nbsp;&nbsp;&nbsp;<?=$info['price'];?>&nbsp;&nbsp;&nbsp;</u>,00</td>
				</tbody>
			</table>
			<p>
				<em><strong>Прохождение итогового тестирования станет доступно с <?=$info['closedate'];?></strong></em><br/>
				<strong>ВНИМАНИЕ!</strong> В случае возникновения каких-либо вопросов относительно данных платежа обращайтесь по тел.: 2-36-53-53
			</p>
		<?php
		endif;
		?>
			<br/><br/>
			<p>
				Наш адрес: г.Ростов-на-Дону, ул.Республиканская, д.86<br/>
				Контактные данные: Тел.:(863) 246-43-54 Эл.почта: info@roscentrdpo.ru<br/>
				С уважением, Администрация Образовательного портала АНО ДПО «Южно-окружной центр повышения квалификации»
			</p>
		<?php
		$mailtext = ob_get_clean();
		
		$this->email->clear(TRUE);
		$config['smtp_host'] = 'localhost';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		
		$this->email->initialize($config);
		$this->email->to($info['email']);
		$this->email->from('admin@roscentrdpo.ru','АНО ДПО');
		$this->email->bcc('');
		$this->email->subject('Уведомление о оплате за обучение');
		$this->email->message($mailtext);
		$this->email->send();
		
		$statusval['retemail'] = $info['email'];
		echo json_encode($statusval);
	}
	
	public function fiz_order_delete(){
		
		$order = $this->uri->segment(5);
		$this->fizordersmodel->update_field($order,'deleted',1);
		$this->session->set_userdata('msgs','Заказ перемещен.');
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function fiz_order_restore(){
		
		$order = $this->uri->segment(5);
		$this->fizordersmodel->update_field($order,'deleted',0);
		$this->session->set_userdata('msgs','Заказ восстановлен.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function fiz_statement(){
		
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Ведомость итог.тестирования',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->fizordersmodel->read_field($order,'paiddate'),
					'dateend'		=> $this->fizordersmodel->read_field($order,'closedate'),
					'hours'			=> 0,
					'courses'		=> $this->fizunionmodel->read_course_physical_records($order)
			);
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		if($pagevar['dateend'] != '0000-00-00'):
			if($pagevar['dateend'] > date("Y-m-d")):
				$pagevar['dateend'] = '0000-00-00';
			endif;
		endif;
		if($pagevar['dateend'] != "0000-00-00"):
			$pagevar['dateend'] = preg_split("/[ ]+/",$this->split_date($pagevar['dateend']));
		else:
			$pagevar['dateend'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['courses']);$i++):
			if($pagevar['courses'][$i]['status']):
				$pagevar['courses'][$i]['dateover'] = $this->operation_dot_date($pagevar['courses'][$i]['dateover']);
			else:
				$pagevar['courses'][$i]['dateover'] = 'обучение не пройдено';
			endif;
			if(!$pagevar['courses'][$i]['start']):
				$pagevar['courses'][$i]['dateover'] = 'обучение не начато';
			endif;
		endfor;
		if(isset($pagevar['courses'][0]['chours'])):
			$pagevar['hours'] = $pagevar['courses'][0]['chours'];
		endif;
		$this->load->view("admin_interface/physical/documents/statement",$pagevar);
	}
	
	public function fiz_completion(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Приказ об окончании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->fizordersmodel->read_field($order,'paiddate'),
					'dateend'		=> $this->fizordersmodel->read_field($order,'closedate'),
					'hours'			=> 0,
					'ncompletion'	=> $this->fizordersmodel->read_field($order,'numbercompletion'),
					'courses'		=> $this->fizunionmodel->read_course_physical_records($order)
			);
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		if($pagevar['dateend'] != '0000-00-00'):
			if($pagevar['dateend'] > date("Y-m-d")):
				$pagevar['dateend'] = '0000-00-00';
			endif;
		endif;
		if($pagevar['dateend'] != "0000-00-00"):
			$pagevar['dateend'] = preg_split("/[ ]+/",$this->split_date($pagevar['dateend']));
		else:
			$pagevar['dateend'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['courses']);$i++):
			if($pagevar['courses'][$i]['status']):
				$pagevar['courses'][$i]['dateover'] = $this->operation_date($pagevar['courses'][$i]['dateover']);
			else:
				$pagevar['courses'][$i]['dateover'] = 'обучение не пройдено';
			endif;
		endfor;
		if(isset($pagevar['courses'][0]['chours'])):
			$pagevar['hours'] = $pagevar['courses'][0]['chours'];
		endif;
		$this->load->view("admin_interface/physical/documents/completion",$pagevar);
	}
	
	public function fiz_admission(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Приказ о зачислении',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->fizordersmodel->read_field($order,'paiddate'),
					'nplacement'	=> $this->fizordersmodel->read_field($order,'numberplacement'),
					'courses'		=> $this->fizunionmodel->read_course_physical_records($order)
			);
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['courses']);$i++):
			if($pagevar['courses'][$i]['status']):
				$pagevar['courses'][$i]['dateover'] = $this->operation_date($pagevar['courses'][$i]['dateover']);
			else:
				$pagevar['courses'][$i]['dateover'] = 'обучение не пройдено';
			endif;
		endfor;
		$this->load->view("admin_interface/physical/documents/admission",$pagevar);
	}
	
	public function fiz_registry(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Реестр слушателей',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->fizordersmodel->read_field($order,'paiddate'),
					'regdateend'	=> '',
					'dateend'		=> $this->fizordersmodel->read_field($order,'closedate'),
					'hours'			=> 0,
					'ncompletion'	=> $this->fizordersmodel->read_field($order,'numbercompletion'),
					'info'			=> $this->fizunionmodel->read_fullinfo_physical($this->uri->segment(5))
			);
		if($pagevar['ncompletion']):
			$pagevar['ncompletion'] = preg_replace("([^0-9])","",$pagevar['ncompletion']);
		endif;
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		if($pagevar['dateend'] != '0000-00-00'):
			if($pagevar['dateend'] > date("Y-m-d")):
				$pagevar['dateend'] = '0000-00-00';
			endif;
		endif;
		if($pagevar['dateend'] != "0000-00-00"):
			$pagevar['regdateend'] = $this->operation_dot_date($pagevar['dateend']);
			$pagevar['dateend'] = preg_split("/[ ]+/",$this->split_date($pagevar['dateend']));
		else:
			$pagevar['regdateend'] = 'Не завершено';
			$pagevar['dateend'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		for($i=0;$i<count($pagevar['info']);$i++):
			if($pagevar['info'][$i]['status']):
				$pagevar['info'][$i]['dateover'] = $this->operation_dot_date($pagevar['info'][$i]['dateover']);
			else:
				$pagevar['info'][$i]['dateover'] = '---';
			endif;
			$pagevar['info'][$i]['orderdate'] = $this->operation_dot_date($pagevar['info'][$i]['orderdate']);
			if($pagevar['info'][$i]['paid']):
				$pagevar['info'][$i]['paiddate'] = $this->operation_dot_date($pagevar['info'][$i]['paiddate']);
			else:
				$pagevar['info'][$i]['paiddate'] = '---';
			endif;
				$pagevar['info'][$i]['userpaiddate'] = $this->operation_dot_date($pagevar['info'][$i]['userpaiddate']);
		endfor;
		if(isset($pagevar['courses'][0]['chours'])):
			$pagevar['hours'] = $pagevar['courses'][0]['chours'];
		endif;
		switch ($this->uri->segment(7)):
			case 'list-1': $this->load->view("admin_interface/physical/documents/registry-list-1",$pagevar); break;
			case 'list-2': $this->load->view("admin_interface/physical/documents/registry-list-2",$pagevar); break;
		endswitch;
	}
	
	public function fiz_reference(){
	
		$order = $this->uri->segment(5);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Справка',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'datebegin'		=> $this->fizordersmodel->read_field($order,'paiddate'),
					'customer'		=> $this->fizunionmodel->read_physical_info_order($order),
					'courses'		=> $this->fizunionmodel->read_course_physical_records($order)
			);
		if($pagevar['datebegin']!='0000-00-00'):
			$pagevar['datebegin'] = preg_split("/[ ]+/",$this->operation_date($pagevar['datebegin']));
		else:
			$pagevar['datebegin'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		$this->load->view("admin_interface/physical/documents/reference",$pagevar);
	}
	
	public function fiz_invoice(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'order'			=> $this->fizordersmodel->read_record($this->uri->segment(5)),
					'course'		=> $this->fizunionmodel->read_corder_group_records($this->uri->segment(5)),
					'customer'		=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'Счет на оплату № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->physicalmodel->read_record($pagevar['order']['physical']);
		$this->load->view("physical_interface/documents/invoice",$pagevar);
	}
	
	public function fiz_contract(){
		
		$this->uri->segment(6);
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'customer'		=> array(),
					'order'			=> $this->fizordersmodel->read_record($this->uri->segment(5)),
					'course'		=> $this->fizunionmodel->read_corder_group_records($this->uri->segment(5)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'Договор № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		$pagevar['customer'] = $this->physicalmodel->read_record($pagevar['order']['physical']);
		
		$this->load->view("physical_interface/documents/contract",$pagevar);
	}
	
	public function fiz_act(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'РосЦентр ДПО - ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'customer'		=> array(),
					'order'			=> $this->fizordersmodel->read_record($this->uri->segment(5)),
					'course'		=> $this->fizunionmodel->read_corder_group_records($this->uri->segment(5)),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['title'] .= 'АКТ об оказании услуг по договору № '.$pagevar['order']['id'].' от '.$pagevar['order']['orderdate'].' года';
		
		$pagevar['order']['orderddate'] = $this->operation_dot_date($pagevar['order']['orderdate']);
		$pagevar['order']['orderdate'] = $this->operation_date($pagevar['order']['orderdate']);
		$pagevar['order']['paiddate'] = $this->operation_dot_date($pagevar['order']['paiddate']);
		if($pagevar['order']['closedate'] != "0000-00-00"):
			$pagevar['order']['closedate'] = $this->operation_date($pagevar['order']['closedate']);
		else:
			$pagevar['order']['closedate'] = array('&nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',date("Y"));
		endif;
		$pagevar['customer'] = $this->physicalmodel->read_record($pagevar['order']['physical']);
		
		$this->load->view("physical_interface/documents/act",$pagevar);
	}
	
	public function fiz_orders_testing(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Итоговые тесты',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'audcourses'	=> $this->fizunionmodel->read_testing_order($this->uri->segment(5)),
					'newcourses'	=> $this->coursesmodel->read_new_courses(5),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['audcourses']);$i++):
			if($pagevar['audcourses'][$i]['status']):
				$pagevar['audcourses'][$i]['dateover'] = $this->operation_dot_date($pagevar['audcourses'][$i]['dateover']);
			else:
				$pagevar['audcourses'][$i]['dateover'] = 'не пройден';
			endif;
		endfor;
		$this->load->view("admin_interface/physical/testing",$pagevar);
	}
	
	public function fiz_test_report_full(){
	
		$reptest = $this->uri->segment(10);
		$course = $this->uri->segment(8);
		$audience = $this->uri->segment(6);
		$order = $this->uri->segment(4);
		if(!$this->fizcoursemodel->read_status($course)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/physical-orders/id/'.$order.'/testing');
		endif;
		
		if(!$this->fiztestresultsmodel->owner_report($course,$reptest)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/physical-orders/id/'.$order.'/testing');
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Отчет о итоговом тестировании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'report'		=> $this->fiztestresultsmodel->read_record($reptest),
					'audience'		=> $this->physicalmodel->read_field($audience,'fio'),
					'test'			=> array(),
					'questions'		=> array(),
					'answers'		=> array()
			);
		
		$pagevar['report']['dataresult'] = unserialize($pagevar['report']['dataresult']);
		$pagevar['test'] = $this->fizunionmodel->read_physical_testing($pagevar['report']['test'],$audience,$pagevar['report']['course']);
		$pagevar['questions'] = $this->testquestionsmodel->read_records($pagevar['test']['tid']);
		$pagevar['answers'] = $this->testanswersmodel->read_records($pagevar['test']['tid']);
		$pagevar['test']['attemptdate'] = $this->operation_date($pagevar['test']['attemptdate']);
		$this->load->view("admin_interface/physical/report",$pagevar);
	}
	
	public function fiz_test_report_short(){
	
		$reptest = $this->uri->segment(10);
		$course = $this->uri->segment(8);
		$audience = $this->uri->segment(6);
		$order = $this->uri->segment(4);
		if(!$this->fizcoursemodel->read_status($course)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/physical-orders/id/'.$order.'/testing');
		endif;
		
		if(!$this->fiztestresultsmodel->owner_report($course,$reptest)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('admin-panel/messages/physical-orders/id/'.$order.'/testing');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Отчет о итоговом тестировании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'info'			=> $this->fizunionmodel->read_fullinfo_report($course,$audience),
					'test'			=> array(),
					'questions'		=> array(),
					'answers'		=> array()
			);
		$pagevar['info']['dateover'] = $this->operation_date($pagevar['info']['dateover']);
		$this->load->view("admin_interface/physical/report-short",$pagevar);
	}

	/******************************************************** functions ******************************************************/
	
	public function fileupload($userfile,$overwrite,$catalog){
		
		$config['upload_path'] 		= './documents/'.$catalog.'/';
		$config['allowed_types'] 	= 'doc|docx|xls|xlsx|txt|pdf';
		$config['remove_spaces'] 	= TRUE;
		$config['overwrite'] 		= $overwrite;
		
		$this->load->library('upload',$config);
		
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

	public function operation_date($field){
			
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1 г."; 
		return preg_replace($pattern, $replacement,$field);
	}
	
	public function split_date($field){
			
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1"; 
		return preg_replace($pattern, $replacement,$field);
	}
	
	public function split_dot_date($field){
			
		$list = preg_split("/\./",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(\.)(\w+)(\.)(\d+)/i";
		$replacement = "\$1 $nmonth \$5"; 
		return preg_replace($pattern, $replacement,$field);
	}
	
	public function operation_dot_date($field){
			
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5.$3.\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}

	function operation_date_slash($field){
		
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5/\$3/\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}
}