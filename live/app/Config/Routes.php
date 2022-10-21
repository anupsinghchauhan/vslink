<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/(:alphanum)', 'Home::index_alphanumeric/$1');
$routes->get('/(:alpha)', 'Home::index_alpha/$1');
$routes->get('/(:num)', 'Home::index_number_url/$1');

$routes->get('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout_function');
$routes->get('/verification', 'Auth::verification');
$routes->get('/forgot-password', 'Auth::forgot_password');
$routes->get('/change-pwd/(:any)', 'Auth::changePWD/$1');


$routes->get('/about-us', 'Info::aboutus');
$routes->get('/contact-us', 'Info::contactus');
$routes->get('/terms-conditions', 'Info::terms');
$routes->get('/privacy-policy', 'Info::privacy');
$routes->get('/help', 'Info::help');
$routes->get('/blogs', 'Info::blogs');

$routes->get('/final-step', 'Shortenalgorithm::step3');
$routes->get('/final-step/(:any)', 'Shortenalgorithm::step3/$1');

$routes->get('/dashboard', 'User::index');
$routes->get('/manage-links', 'User::manage_links');
$routes->get('/statistics', 'User::statistics');
$routes->get('/settings', 'User::settings');
$routes->get('/withdraw', 'User::withdraw');
$routes->get('/referal', 'User::referal');
$routes->get('/invoices', 'User::invoices');


$routes->get('/send-query', 'Contactquery::index');


//admin control

$routes->get('/admin-dashboard', 'Admin::admin_dashboard');
$routes->get('/user-queries', 'Admin::user_queries');
$routes->get('/contact-queries', 'Admin::contact_queries');
$routes->get('/change-password', 'Admin::change_password');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
