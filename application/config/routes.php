<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "/users";
$route['users'] = "/users/login_reg_view";
$route['appointments/(:num)'] = "/appointments/appointment_view/$1";
$route['appointments'] = "/appointments/appointments_view";
$route['add'] = "/appointments/add";
$route['delete/(:num)'] = "/appointments/delete/$1";
$route['done/(:num)'] = "/appointments/mark_complete/$1";
$route['logout'] = "/users/logout";
$route['404_override'] = '';
