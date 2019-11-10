<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['trainees'] = 'trainees/index';

$route['supervisors/training'] = 'supervisors/view/training';
$route['supervisors/home'] = 'supervisors/view/home';
$route['supervisors/add_Trainee'] = 'supervisors/view/add_Trainee';
$route['supervisors/view_Trainee'] = 'supervisors/view/view_Trainee';
$route['supervisors/add_Supervisor'] = 'supervisors/view/add_Supervisor';
$route['supervisors'] = 'supervisors/index';
$route['supervisors/(:any)'] = 'supervisors/$1';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
