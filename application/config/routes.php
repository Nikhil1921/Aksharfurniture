<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'home/error';
$route['change-boid'] = 'home/change_boid';
$route['logout'] = 'login/logout';
$route['translate_uri_dashes'] = TRUE;