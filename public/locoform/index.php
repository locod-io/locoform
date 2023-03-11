<?php

$_baseDir = "../../";

require $_baseDir . 'vendor/autoload.php';
require $_baseDir . 'locoform/bootstrap.php';

use App\LocoForm\Config;

$f3 = \Base::instance();
$f3->set('AUTOLOAD', $_baseDir . 'locoform/');

// todo route caching for production

//-- form routes -------------------------------------------------------------------------------------------------------
$f3->route('GET @form: /@formCode', 'App\LocoForm\Controllers\App->form');
$f3->route('POST @fillForm: /@formCode', 'App\LocoForm\Controllers\App->fillForm');
$f3->route('GET @page: /p/@formCode/@pageCode', 'App\LocoForm\Controllers\App->page');

//-- admin routes ------------------------------------------------------------------------------------------------------
$f3->route('GET @start: /', 'App\LocoForm\Controllers\App->start');
$f3->route('GET @admin: /' . Config::ADMIN_URL, 'App\LocoForm\Controllers\App->admin');
$f3->route('GET @admin_login: /' . Config::ADMIN_URL . 'login', 'App\LocoForm\Controllers\App->auth');
$f3->route('POST @admin_login_action: /' . Config::ADMIN_URL . '/login', 'App\LocoForm\Controllers\App->authAction');
$f3->route('GET @admin_logout: /' . Config::ADMIN_URL . '/logout', 'App\LocoForm\Controllers\App->logout');

//-- api routes --------------------------------------------------------------------------------------------------------

$f3->run();