<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/***************************************************	USERS INTRERFACE	***********************************************/
$route[''] = "users_interface/index";
$route['admin'] = "users_interface/admin_login";


/***************************************************	ADMIN INTRERFACE	***********************************************/
$route['admin-panel'] = "admin_interface/admin_panel";

$route['admin-logoff'] = "admin_interface/admin_logoff";
$route['admin-cabinet'] = "admin_interface/admin_cabinet";

$route['admin-panel/references/trends']		= "admin_interface/references_trends";
$route['admin-panel/references/courses']	= "admin_interface/references_courses";