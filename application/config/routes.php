<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

/***************************************************	USERS INTRERFACE	***********************************************/
$route[''] 								= "users_interface/index";
$route['main-page'] 					= "users_interface/index";
$route['admin'] 						= "users_interface/admin_login";
$route['logoff'] 						= "users_interface/logoff";
$route['password-restore'] 				= "users_interface/password_restore";
$route['registration/customer'] 		= "users_interface/registration_customer";
$route['registration/customer/step/1'] 	= "users_interface/registration_customer_step_1";
$route['registration/customer/step/2'] 	= "users_interface/registration_customer_step_2";
$route['registration/customer/step/3'] 	= "users_interface/registration_customer_step_3";
$route['registration/customer/step/4'] 	= "users_interface/registration_customer_step_4";
$route['registration/customer/finish'] 	= "users_interface/registration_customer_step_4";
$route['registration/customer/close-registration'] 	= "users_interface/registration_close";
$route['registration/customer/cancel-registration'] = "users_interface/registration_cancel";
$route['catalog/courses'] 				= "users_interface/catalog_courses";
$route['contacts'] 						= "users_interface/contacts";
$route['information'] 					= "users_interface/information";

/******************************************************** CUSTOMER INTRERFACE ***********************************************/

$route['customer/information/start-page']						= "customer_interface/start_page";
$route['customer/edit/profile']									= "customer_interface/customer_profile";
$route['customer/registration/audience']						= "customer_interface/registration_audience";
$route['customer/registration/ordering']						= "customer_interface/registration_ordering";
$route['customer/audience/list']								= "customer_interface/audience_list";
$route['customer/audience/orders']								= "customer_interface/orders_list";
$route['customer/audience/orders/delete-order/:num']			= "customer_interface/orders_delete_order";
$route['customer/audience/orders/order-information/id/:num']	= "customer_interface/orders_order_information";

$route['customer/audience/orders/order-information/id/:num/invoice-for-payment']	= "customer_interface/orders_order_invoice";
$route['customer/audience/orders/order-information/id/:num/contract']				= "customer_interface/orders_order_contract";
$route['customer/audience/orders/order-information/id/:num/act-to-contract']		= "customer_interface/orders_order_act";



/******************************************************** AUDIENCE INTRERFACE ***********************************************/

$route['audience/view/profile']													= "audience_interface/audience_profile";
$route['audience/courses/current']												= "audience_interface/audience_courses_currect";
$route['audience/courses/current/start-training/:num']							= "audience_interface/audience_start_training";
$route['audience/courses/completed']											= "audience_interface/audience_courses_completed";
$route['audience/courses/current/course/:num/lectures']							= "audience_interface/audience_courses_lectures";
$route['audience/courses/current/course/:num/lecture/:num']						= "audience_interface/audience_courses_lecture";
$route['audience/courses/current/course/:num/lecture/:num/get-document']		= "audience_interface/audience_get_document";
$route['audience/courses/current/course/:num/lectures/get-libraries']			= "audience_interface/audience_get_libraries";
$route['audience/courses/current/course/:num/lectures/get-curriculum']			= "audience_interface/audience_get_curriculum";
$route['audience/courses/current/course/:num/lectures/testing/id/:num']			= "audience_interface/audience_testing";
$route['audience/courses/current/course/:num/lectures/final-testing/id/:num'] 	= "audience_interface/audience_testing";
$route['audience/courses/:num/test-report/id/:num'] 							= "audience_interface/audience_test_report";

/*==========================================================  ordering  ===================================================*/

$route['customer/registration/ordering/step/1']	= "customer_interface/registration_ordering_step1";
$route['customer/registration/ordering/step/2']	= "customer_interface/registration_ordering_step2";
$route['customer/registration/ordering/step/3']	= "customer_interface/registration_ordering_step3";

$route['customer/registration/ordering/step/2/delete-course/:num']	= "customer_interface/registration_delete_course";
$route['customer/registration/ordering/cancel-registration']		= "customer_interface/registration_ordering_cancel";

$route['customer/registration/ordering/step/2/course/:num/delete-audience/:num']	= "customer_interface/registration_delete_audience";

/***************************************************	ADMIN INTRERFACE	***********************************************/
$route['admin-panel/logoff'] 				= "admin_interface/admin_logoff";

$route['admin-panel/actions/control'] 					= "admin_interface/admin_panel";
$route['admin-panel/actions/control/delete-date/:num'] 	= "admin_interface/datele_date";
$route['admin-panel/actions/cabinet'] 					= "admin_interface/admin_cabinet";
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
$route['admin-panel/messages/search/orders']					= "admin_interface/orders_search";
$route['admin-panel/messages/search/orders/new-search']			= "admin_interface/orders_search";
$route['admin-panel/messages/search-customer']					= "admin_interface/search_customer";

$route['admin-panel/messages/orders/all']					= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/all/:num']				= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/active']				= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/active/:num']			= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/deactive']				= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/deactive/:num']			= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/sponsored']				= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/sponsored/:num']		= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/unpaid']				= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/unpaid/:num']			= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/paid-order']			= "admin_interface/orders_paid";
$route['admin-panel/messages/orders/send-mail'] 			= "admin_interface/orders_send_mail";
$route['admin-panel/messages/orders/delete-order/:num']		= "admin_interface/order_delete";

/*===========================================================  users  =====================================================*/
$route['admin-panel/users/customer']						= "admin_interface/users_customer";
$route['admin-panel/users/customer/info/id/:num']			= "admin_interface/users_customer_info";

$route['admin-panel/users/customer/load-courses']			= "admin_interface/users_customer_load_courses";

$route['admin-panel/users/customer/set-customer-access']	= "admin_interface/customer_access";
$route['admin-panel/users/customer/delete-customer/:num']	= "admin_interface/delete_customer";
$route['admin-panel/users/audience']						= "admin_interface/users_audience";
$route['admin-panel/users/audience/info/id/:num']			= "admin_interface/users_audience_info";
$route['admin-panel/users/audience/set-audience-access']	= "admin_interface/audience_access";
$route['admin-panel/users/audience/delete-audience/:num']	= "admin_interface/delete_audience";

/*=========================================================== documents  ====================================================*/
$route['admin-panel/messages/orders/id/:num/statement']			= "admin_interface/statement";
$route['admin-panel/messages/orders/id/:num/completion']		= "admin_interface/completion";
$route['admin-panel/messages/orders/id/:num/admission']			= "admin_interface/admission";
$route['admin-panel/messages/orders/id/:num/registry/list-1']	= "admin_interface/registry";
$route['admin-panel/messages/orders/id/:num/registry/list-2']	= "admin_interface/registry";
$route['admin-panel/messages/orders/id/:num/reference']			= "admin_interface/reference";

/*=========================================================== documents  ====================================================*/
$route['admin-panel/messages/orders/id/:num/testing']												= "admin_interface/orders_testing";
$route['admin-panel/messages/orders/:num/audience/:num/courses/:num/test-report/:num/full']			= "admin_interface/test_report_full";
$route['admin-panel/messages/orders/:num/audience/:num/courses/:num/test-report/:num/short']		= "admin_interface/test_report_short";

$route['admin-panel/messages/orders/:any/:any/:any'] 		= "admin_interface/orders_messages";
$route['admin-panel/messages/orders/:any/:num/:any/:any']	= "admin_interface/orders_messages";