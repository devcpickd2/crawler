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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'login/login';

$route['login'] = 'login/auth';
$route['home'] = 'home';

$route['departemen'] = 'departemen';
$route['departemen/tambah'] = 'departemen/tambah';
$route['departemen/edit/(:any)'] = 'departemen/edit/$1';

$route['pegawai'] = 'pegawai';
$route['pegawai/tambah'] = 'pegawai/tambah';
$route['pegawai/edit/(:any)'] = 'pegawai/edit/$1';
$route['pegawai/edituser/(:any)'] = 'pegawai/edituser/$1';
$route['pegawai/editpass/(:any)'] = 'pegawai/editpass/$1';

$route['termo'] = 'termo';
$route['termo/tambah'] = 'termo/tambah';
$route['termo/edit/(:any)'] = 'termo/edit/$1';

$route['timbangan'] = 'timbangan';
$route['timbangan/tambah'] = 'timbangan/tambah';
$route['timbangan/edit/(:any)'] = 'timbangan/edit/$1';

$route['verif_premix'] = 'verif_premix';
$route['verif_premix/tambah'] = 'verif_premix/tambah';
$route['verif_premix/edit/(:any)'] = 'verif_premix/edit/$1';

$route['verif_intitusi'] = 'verif_intitusi';
$route['verif_intitusi/tambah'] = 'verif_intitusi/tambah';
$route['verif_intitusi/edit/(:any)'] = 'verif_intitusi/edit/$1';

$route['pem_masak_steamer'] = 'pem_masak_steamer';
$route['pem_masak_steamer/tambah'] = 'pem_masak_steamer/tambah';
$route['pem_masak_steamer/edit/(:any)'] = 'pem_masak_steamer/edit/$1';

$route['suhu_ruangan'] = 'suhu_ruangan';
$route['suhu_ruangan/tambah'] = 'suhu_ruangan/tambah';
$route['suhu_ruangan/edit/(:any)'] = 'suhu_ruangan/edit/$1';

$route['pem_sanitasi'] = 'pem_sanitasi';
$route['pem_sanitasi/tambah'] = 'pem_sanitasi/tambah';
$route['pem_sanitasi/edit/(:any)'] = 'pem_sanitasi/edit/$1';

$route['sanitasi'] = 'sanitasi';
$route['sanitasi/tambah'] = 'sanitasi/tambah';
$route['sanitasi/edit/(:any)'] = 'sanitasi/edit/$1';

$route['my_profile'] = 'profile/my_profile';
$route['setting'] = 'profile/setting';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'login/logout';