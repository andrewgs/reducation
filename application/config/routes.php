<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/***************************************************	USERS INTRERFACE	***********************************************/
$route[''] = "users_interface/index";
$route['admin'] = "users_interface/admin_login";


/***************************************************	ADMIN INTRERFACE	***********************************************/
$route['admin-logoff'] = "admin_interface/admin_logoff";

$route['admin-panel/actions/control'] 		= "admin_interface/admin_panel";
$route['admin-panel/actions/cabinet'] 		= "admin_interface/admin_cabinet";
/*==========================================================  trends  ====================================================*/
$route['admin-panel/references/trends']						= "admin_interface/references_trends";
$route['admin-panel/references/trends/delete-trend/:num']	= "admin_interface/references_delete_trend";

/*==========================================================  courses  ===================================================*/
$route['admin-panel/references/courses']	= "admin_interface/references_courses";

$route['admin-panel/messages/private']		= "admin_interface/private_messages";
$route['admin-panel/messages/support']		= "admin_interface/support_messages";
$route['admin-panel/messages/applications']	= "admin_interface/applications_messages";