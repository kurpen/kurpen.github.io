<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['book/(:any)'] = 'rezerwacja/book/$1';
$route['book'] = 'rezerwacja/book';
$route['miasto/(:any)'] = 'lokale/city/$1';
$route['miasto'] = 'lokale/city';
$route['rezerwacje'] = 'profile/rezerwacje';
$route['profile'] = 'profile/index';
$route['change_password'] = 'auth/change_password';
$route['edit/(:any)'] = 'auth/edit_user/$1';
$route['signup'] = 'auth/create_user';
$route['login'] = 'auth/login';
$route['home'] = 'home';
$route['upload'] = 'upload';
$route['lokale/miasto/(:any)'] = 'lokale/city/$1';
$route['lokale/miasto'] = 'lokale/city';
$route['lokale/create'] = 'lokale/create';
$route['lokale/(:any)'] = 'lokale/view/$1';
$route['lokale'] = 'lokale';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
$route['translate_uri_dashes'] = FALSE;
