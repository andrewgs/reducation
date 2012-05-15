<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Audience_interface extends CI_Controller{
	
	var $user = array('uid'=>0,'ulogin'=>'','uemail'=>'','utype'=>'','fullname'=>'');
	var $loginstatus = array('zak'=>FALSE,'slu'=>FALSE,'adm'=>FALSE,'status'=>FALSE);
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
		$this->load->model('audiencetestmodel');
		$this->load->model('testresultsmodel');
		
		$cookieuid = $this->session->userdata('logon');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				if($this->session->userdata('utype') != 'slu'):
					redirect('');
				endif;
				$userinfo = $this->audiencemodel->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ulogin'] 			= $userinfo['login'];
					$this->user['uemail'] 			= '';
					$this->user['utype'] 			= $this->session->userdata('utype');
					$this->user['fullname'] 		= $this->audiencemodel->read_full_name($this->user['uid']);
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
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Профиль слушателя курсов',
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
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои текущие курсы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'courses'		=> $this->unionmodel->read_audience_courses($this->user['uid'],0),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		for($i=0;$i<count($pagevar['courses']);$i++):
			$pagevar['courses'][$i]['chapter'] = $this->chaptermodel->count_records($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['tests'] = $this->testsmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['lectures'] = $this->lecturesmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['test'] = $this->audiencetestmodel->read_exam_test_info($pagevar['courses'][$i]['order'],$pagevar['courses'][$i]['aud'],$this->user['uid']);
			$pagevar['courses'][$i]['test']['count'] = $this->testsmodel->read_field($pagevar['courses'][$i]['test']['test'],'count');
		endfor;
		$this->load->view("audience_interface/courses-currect",$pagevar);
	}
	
	public function audience_courses_completed(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Мои текущие курсы',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'courses'		=> $this->unionmodel->read_audience_courses($this->user['uid'],1),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['courses']);$i++):
			$pagevar['courses'][$i]['chapter'] = $this->chaptermodel->count_records($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['tests'] = $this->testsmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['lectures'] = $this->lecturesmodel->count_course_record($pagevar['courses'][$i]['id']);
			$pagevar['courses'][$i]['test'] = $this->audiencetestmodel->read_exam_test_info($pagevar['courses'][$i]['order'],$pagevar['courses'][$i]['aud'],$this->user['uid']);
			$pagevar['courses'][$i]['test']['count'] = $this->testsmodel->read_field($pagevar['courses'][$i]['test']['test'],'count');
			$pagevar['courses'][$i]['test']['tresid'] = $this->audienceordermodel->read_field($pagevar['courses'][$i]['aud'],'tresid');
		endfor;
		$this->load->view("audience_interface/courses-completed",$pagevar);
	}
	
	public function audience_test_report(){
		
		$reptest = $this->uri->segment(6);
		$course = $this->uri->segment(3);
		if(!$this->audienceordermodel->read_status($course)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('audience/courses/completed');
		endif;
		
		if(!$this->testresultsmodel->exist_report($this->user['uid'],$course,$reptest)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к отчету.');
			redirect('audience/courses/completed');
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО | Отчет о итоговом тестировании',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'report'		=> $this->testresultsmodel->read_record($reptest),
					'test'			=> array(),
					'questions'		=> array(),
					'answers'		=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$pagevar['report']['dataresult'] = unserialize($pagevar['report']['dataresult']);
		$pagevar['test'] = $this->unionmodel->read_audience_testing($pagevar['report']['test'],$this->user['uid'],$pagevar['report']['course']);
		$pagevar['questions'] = $this->testquestionsmodel->read_records($pagevar['test']['tid']);
		$pagevar['answers'] = $this->testanswersmodel->read_records($pagevar['test']['tid']);
		$pagevar['test']['attemptdate'] = $this->operation_date($pagevar['test']['attemptdate']);
		$this->load->view("audience_interface/test-report",$pagevar);
	}
	
	public function audience_start_training(){
		
		$training = $this->uri->segment(5);
		if($training):
			if(!$this->audienceordermodel->owner_audience($training,$this->user['uid'],0)):
				$this->session->set_userdata('msgr','Не возможно начать обучение.');
				redirect('audience/courses/current');
			endif;
			if($this->audienceordermodel->read_field($training,'start')):
				$this->session->set_userdata('msgr','Обучение уже начато.');
				redirect('audience/courses/current');
			endif;
			$this->session->set_userdata('msgs','Обучение начато! Теперь Вам доступны лекции для ознакомления.<br/>Читайте лекции и сдавайте тесты. Удачи!');
			$this->audienceordermodel->update_field($training,'start',1);
			$tests = $this->unionmodel->get_courses_test($training,$this->user['uid'],0);
			for($i=0;$i<count($tests);$i++):
				$this->audiencetestmodel->insert_record($tests[$i]['aoid'],$this->user['uid'],$tests[$i]['ordid'],$tests[$i]['ordcus'],$tests[$i]['chapter'],$tests[$i]['id']);
			endfor;
			$test = $this->unionmodel->get_courses_examination($training,$this->user['uid'],0);
			$this->audiencetestmodel->insert_record($test['aoid'],$this->user['uid'],$test['ordid'],$test['ordcus'],$test['chapter'],$test['id']);
		endif;
		redirect('audience/courses/current');
	}
	
	public function audience_courses_lectures(){
		
		$course = $this->uri->segment(5);
		if(!$this->audienceordermodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('audience/courses/current');
		endif;
		
		if(!$this->audienceordermodel->read_field($course,'start')):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('audience/courses/current');
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Список лекций',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'course'		=> $this->unionmodel->read_audience_currect_course($this->user['uid'],$course,0),
					'chapters'		=> array(),
					'test'			=> array(),
					'finaltest'		=> 0,
					'docvalue'		=> 'Список литературы',
					'document'		=> $this->unionmodel->read_course_libraries($this->user['uid'],$course,0),
					'curriculum'	=> $this->unionmodel->read_course_curriculum($this->user['uid'],$course,0),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['chapters'] = $this->chaptermodel->read_records($pagevar['course']['id']);
		
		for($i=0;$i<count($pagevar['chapters']);$i++):
			$pagevar['chapters'][$i]['lectures'] = $this->lecturesmodel->read_views_records($pagevar['course']['id'],$pagevar['chapters'][$i]['id']);
			$pagevar['chapters'][$i]['test'] = $this->audiencetestmodel->read_records($course,$pagevar['course']['ordid'],$pagevar['chapters'][$i]['id'],$this->user['uid']);
			$pagevar['chapters'][$i]['test']['count'] = $this->testsmodel->read_field($pagevar['chapters'][$i]['test']['test'],'count');
		endfor;
		$pagevar['test'] = $this->audiencetestmodel->read_records($course,$pagevar['course']['ordid'],0,$this->user['uid']);
		$pagevar['test']['count'] = $this->testsmodel->read_field($pagevar['test']['test'],'count');
		$this->load->view("audience_interface/courses-lectures",$pagevar);
	}
	
	public function audience_testing(){
		
		$course = $this->uri->segment(5);
		if(!$this->audienceordermodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к к лекциям курса.');
			redirect('audience/courses/current');
		endif;
		
		if(!$this->audienceordermodel->read_field($course,'start')):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('audience/courses/current');
		endif;
		$test = $this->uri->segment(9);
		if(!$this->audiencetestmodel->owner_testing($test,$course,$this->user['uid'])):
			$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
			redirect('audience/courses/current/course/'.$course.'/lectures');
		endif;
		
		if($this->uri->segment(7) == 'final-testing'):
			if(!$this->audiencetestmodel->owner_final_testing($test,$course,$this->user['uid'])):
				$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
				redirect('audience/courses/current/course/'.$course.'/lectures');
			endif;
		endif;
		if($this->uri->segment(7) == 'testing'):
			if(!$this->audiencetestmodel->owner_nonfinal_testing($test,$course,$this->user['uid'])):
				$this->session->set_userdata('msgr','Не возможно получить доступ к тесту.');
				redirect('audience/courses/current/course/'.$course.'/lectures');
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | Тестирование',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'course'		=> $this->unionmodel->read_audience_currect_course($this->user['uid'],$course,0),
					'test'			=> $this->unionmodel->read_audience_testing($test,$this->user['uid'],$course),
					'questions'		=> array(),
					'answers'		=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['questions'] = $this->testquestionsmodel->read_records($pagevar['test']['test']);
		$pagevar['answers'] = $this->testanswersmodel->read_records($pagevar['test']['test']);
		if($this->input->post('submit')):
		
			unset($_POST['submit']);
			$ttime = $_POST['time'];
			unset($_POST['time']);
			$corranswers = $this->testanswersmodel->read_correct_answers($pagevar['test']['test']);
			$ccanswer = 0; $i = 0;
			foreach ($_POST AS $id=>$corr):
				for($i=0;$i<count($corranswers);$i++):
					if($id == $corranswers[$i]['numb']):
						if($corr == $corranswers[$i]['id']):
							$ccanswer++;
						endif;
					endif;
				endfor;
			endforeach;
			$ccanswer = round($ccanswer/count($corranswers)*100);
			$this->audiencetestmodel->update_result($test,$ccanswer,round($ttime/60));
			if($ccanswer > 60):
				$this->session->set_userdata('msgs','Тест завершен!<br/>Поздравляем Вы успешно прошли тест и ответили верно на '.$ccanswer.'% вопросов.');
				if($this->uri->segment(7) == 'final-testing'):
					$this->audienceordermodel->over_course($course,1,$ccanswer);
					$order = $this->audienceordermodel->read_field($course,'order');
					$customer = $this->audienceordermodel->read_field($course,'order');
					$dataresult = serialize($_POST);
					$id = $this->testresultsmodel->insert_record($course,$this->user['uid'],$order,$customer,$test,$dataresult,$ccanswer);
					$this->audienceordermodel->update_field($course,'tresid',$id);
					
					$cntcurclose = $this->unionmodel->count_deactive_order($order);
					$cnttotal = $this->audienceordermodel->count_audience_by_order($order);
					if($cntcurclose == $cnttotal):
						$this->ordersmodel->update_field($order,'closedate',date("Y-m-d"));
					endif;
					redirect('audience/courses/completed');
				endif;
			else:
				$this->session->set_userdata('msgr','Тест не завершен!<br/>Вы не прошли тест и ответили верно только на '.$ccanswer.'% вопросов.');
			endif;
			redirect('audience/courses/current/course/'.$this->uri->segment(5).'/lectures');
		endif;
		$this->load->view("audience_interface/courses-chapter-testing",$pagevar);
	}
	
	public function audience_courses_lecture(){
		
		$course = $this->uri->segment(5);
		if(!$this->audienceordermodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекциям курса.');
			redirect('audience/courses/current');
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'АНО ДПО Южно-окружной центр повышения квалификации и переподготовки кадров | ',
					'baseurl' 		=> base_url(),
					'loginstatus'	=> $this->loginstatus,
					'userinfo'		=> $this->user,
					'lecture'		=> $this->lecturesmodel->read_record($this->uri->segment(7)),
					'course'		=> $this->unionmodel->read_audience_currect_course($this->user['uid'],$course,0),
					'file_exist'	=> TRUE,
					'filesize'		=> 'Размер не определен.',
					'filename'		=> 'Имя не определено. Возможно файл отсутствует на диске или не доступен',
					'fileextension'	=> 'Hасширение не определено.',
					'docvalue'		=> '',
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$pagevar['title'] .= 'Содержание курса "'.$pagevar['course']['code'].'. '.$pagevar['course']['title'].'"'; 
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
		else:
			$pagevar['file_exist'] = FALSE;
			$pagevar['msgr'] = 'Не возможно получить доступ к лекции. Возможно файл отсутствует на диске или не доступен.';
		endif;
		
		if($pagevar['filesize'] > 1048576):
			$pagevar['filesize'] = round($pagevar['filesize']/1048576,2).' Мбайт';
		elseif($pagevar['filesize'] > 1024):
			$pagevar['filesize'] = round($pagevar['filesize']/1024,1).' кбайт';
		elseif($pagevar['filesize'] < 1024):
			$pagevar['filesize'] = $pagevar['filesize'].' байт';
		endif;
		
		$this->load->view("audience_interface/audience-lecture-card",$pagevar);
	}
	
	public function audience_get_document(){
		
		$lecture = $this->uri->segment(7);
		$course = $this->uri->segment(5);
		if(!$this->audienceordermodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к лекции курса.');
			redirect('audience/courses/current');
		endif;
		$this->load->helper('download');
		$file = getcwd().'/'.$this->lecturesmodel->read_field($lecture,'document');
		if(!file_exists($file)):
			$this->session->set_userdata('msgr','Ошибка при загузке лекции. Отсутствует файл на сервере. Обратитесь к администрации сайта.');
			redirect('audience/courses/current/course/'.$course.'/lecture/'.$lecture);
		endif;
		$data = file_get_contents($file);
		$fileexp = explode('/',$this->lecturesmodel->read_field($lecture,'document'));
		if($fileexp && isset($fileexp[2])):
			$filename = $fileexp[2];
		endif;
		if($data && $filename):
			force_download($filename,$data);
		else:
			$this->session->set_userdata('msgr','Ошибка при загузке лекции. Обратитесь к администрации сайта.');
			redirect('audience/courses/current/course/'.$course.'/lecture/'.$lecture);
		endif;
	}
	
	public function audience_get_libraries(){
		
		$course = $this->uri->segment(5);
		if(!$this->audienceordermodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к списку литературы курса.');
			redirect('audience/courses/current');
		endif;
		
		$this->load->helper('download');
		$file = getcwd().'/'.$this->unionmodel->read_course_libraries($this->user['uid'],$course,0);
		if(!file_exists($file)):
			$this->session->set_userdata('msgr','Ошибка при загузке списка литературы. Отсутствует файл на сервере. Обратитесь к администрации сайта.');
			redirect('audience/courses/current/course/'.$course.'/lectures');
		endif;
		$data = file_get_contents($file);
		$fileexp = explode('/',$this->unionmodel->read_course_libraries($this->user['uid'],$course,0));
		if($fileexp && isset($fileexp[2])):
			$filename = $fileexp[2];
		endif;
		if($data && $filename):
			force_download($filename,$data);
		else:
			$this->session->set_userdata('msgr','Ошибка при загузке списка литературы. Обратитесь к администрации сайта.');
			redirect('audience/courses/current/course/'.$course.'/lectures');
		endif;
	}
	
	public function audience_get_curriculum(){
		
		$course = $this->uri->segment(5);
		if(!$this->audienceordermodel->owner_audience($course,$this->user['uid'],0)):
			$this->session->set_userdata('msgr','Не возможно получить доступ к учебному плану курса.');
			redirect('audience/courses/current');
		endif;
		
		$this->load->helper('download');
		$file = getcwd().'/'.$this->unionmodel->read_course_curriculum($this->user['uid'],$course,0);
		if(!file_exists($file)):
			$this->session->set_userdata('msgr','Ошибка при загузке учебного плана. Отсутствует файл на сервере. Обратитесь к администрации сайта.');
			redirect('audience/courses/current/course/'.$course.'/lectures');
		endif;
		$data = file_get_contents($file);
		$fileexp = explode('/',$this->unionmodel->read_course_curriculum($this->user['uid'],$course,0));
		if($fileexp && isset($fileexp[2])):
			$filename = $fileexp[2];
		endif;
		if($data && $filename):
			force_download($filename,$data);
		else:
			$this->session->set_userdata('msgr','Ошибка при загузке учебного плана. Обратитесь к администрации сайта.');
			redirect('audience/courses/current/course/'.$course.'/lectures');
		endif;
	}
	
	public function operation_date($field){
			
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1 г."; 
		return preg_replace($pattern, $replacement,$field);
	}

	public function operation_dot_date($field){
			
		$list = preg_split("/-/",$field);
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5.$3.\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}
}