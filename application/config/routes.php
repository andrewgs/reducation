<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/***************************************************	USERS INTRERFACE	***********************************************/
$route[''] = "users_interface/index";
$route['admin'] 						= "users_interface/admin_login";
$route['registration/customer'] 		= "users_interface/registration_customer";
$route['registration/customer/step/1'] 	= "users_interface/registration_customer_step_1";
$route['catalog/courses'] 				= "users_interface/catalog_courses";
$route['contacts'] 						= "users_interface/contacts";


/***************************************************	ADMIN INTRERFACE	***********************************************/
$route['admin-logoff'] = "admin_interface/admin_logoff";

$route['admin-panel/actions/control'] 		= "admin_interface/admin_panel";
$route['admin-panel/actions/cabinet'] 		= "admin_interface/admin_cabinet";
/*==========================================================  trends  ====================================================*/
$route['admin-panel/references/trends']						= "admin_interface/references_trends";
$route['admin-panel/references/trends/delete-trend/:num']	= "admin_interface/references_delete_trend";
/*==========================================================  course  ====================================================*/
$route['admin-panel/references/courses']								= "admin_interface/references_courses";
$route['admin-panel/references/courses/delete-course/:num/trend/:num']	= "admin_interface/references_delete_course";

/*==========================================================  chapters  ====================================================*/
$route['admin-panel/references/trend/:num/course/:num']										= "admin_interface/references_chapters";
$route['admin-panel/references/trend/:num/course/:num/delete-lecture/:num']					= "admin_interface/references_delete_lecture";
$route['admin-panel/references/trend/:num/course/:num/delete-chapter/:num']					= "admin_interface/references_delete_chapter";
$route['admin-panel/references/trend/:num/course/:num/lecture/:num']						= "admin_interface/references_lecture_card";
$route['admin-panel/references/trend/:num/course/:num/chapter/:num/delete-test/:num']		= "admin_interface/references_delete_test";
$route['admin-panel/references/trend/:num/course/:num/chapter/:num/testing/:num']			= "admin_interface/references_edit_test";
$route['admin-panel/references/trend/:num/course/:num/chapter/:num/testing/:num/create-master-test'] = "admin_interface/references_master_test";
$route['admin-panel/references/trend/:num/course/:num/chapter/:num/testing/:num/delete-question/:num']	= "admin_interface/references_delete_question";
$route['admin-panel/references/trend/:num/course/:num/chapter/:num/testing/:num/delete-answer/:num']	= "admin_interface/references_delete_answer";

/*==========================================================  messages  ===================================================*/
$route['admin-panel/messages/private']		= "admin_interface/private_messages";
$route['admin-panel/messages/support']		= "admin_interface/support_messages";
$route['admin-panel/messages/applications']	= "admin_interface/applications_messages";