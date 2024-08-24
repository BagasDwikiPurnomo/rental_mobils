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

// User Page
$route['default_controller'] = 'Car_controller';
$route['payment'] = 'Admin/Payment';
$route['assets/(:any)'] = 'assets/$1';
$route['user/create'] = 'User_controller/create';
$route['user'] = 'User/User_controller';
$route['login'] = 'User/Login_controller';
$route['logout'] = 'User/login_controller/logout';
$route['login_controller/login'] = 'User/login_controller/login';
$route['register'] = 'User/Register_controller';
$route['allcars'] = 'Cars/allCars_controller';
$route['reviewcars'] = 'Cars/reviewCars_controller';
$route['detailcars'] = 'Cars/detailCars_controller';
$route['contactus'] = 'contactUs_controller';
$route['midtrans'] = 'Billing/snap';
$route['carhistory'] = 'Cars/carHistory_controller';
// $route['billing'] = 'Billing/Billing_controller';
$route['home'] = 'Car_controller';
$route['contactus/send_message'] = 'contactUs_controller/send_message';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['snap/token'] = 'Billing/snap/token';
$route['snap/finish'] = 'Billing/snap/finish';


// Admin Page
$route['admin'] = 'Admin/Admin_controller';
$route['dashboard'] = 'Admin/Dashboard_controller';
$route['add_car'] = 'Admin/Carlist_controller/add_car';
$route['admincarlist'] = 'Admin/Carlist_controller';
$route['editcar'] = 'Admin/Carlist_controller/edit_car/';
$route['deletecar'] = 'Admin/Carlist_controller/delete_car/';
$route['admincarindex'] = 'Admin/Carlist_controller/index';
$route['rent'] = 'Admin/rent_controller';
$route['updatecar'] = 'Admin/Carlist_controller/update_car';
$route['export_to_excel'] = 'Admin/Rent_controller/export_to_excel';


//  'Admin/Carlist_controller/addcar';






