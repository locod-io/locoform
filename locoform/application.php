<?php

/*
 * This file is part of the LocoForm software.
 *
 * (c) Koen Caerels
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\LocoForm\Infrastructure\Config;
use RedBeanPHP\R as R;

R::ext('locoDispense', function ($type) {
    return R::getRedBean()->dispense($type);
});

R::setup(
    'mysql:host=' . Config::DB_SERVER . ':' . Config::DB_SERVER_PORT . ';dbname=' . Config::DB_NAME,
    Config::DB_USER,
    Config::DB_PWD
);

$f3 = \Base::instance();
$f3->set('AUTOLOAD', Config::APP_RELATIVE_DIR . 'locoform/');
$f3->set('CACHE', 'folder=' . Config::APP_RELATIVE_DIR . 'locoform/' . Config::DATA_FOLDER . '/_tmp');

// TODO route caching for production

//-- form routes -------------------------------------------------------------------------------------------------------
$f3->route('GET @form: /@formCode', 'App\LocoForm\Infrastructure\Controllers\Form->form');
$f3->route('POST @fillForm: /@formCode', 'App\LocoForm\Infrastructure\Controllers\Form->fillForm');
$f3->route('GET @page: /p/@formCode/@pageCode', 'App\LocoForm\Infrastructure\Controllers\Form->page');

//-- application routes ------------------------------------------------------------------------------------------------
$f3->route('GET @start: /', 'App\LocoForm\Infrastructure\Controllers\App->start');
$f3->route('GET @admin: /' . Config::ADMIN_URL, 'App\LocoForm\Infrastructure\Controllers\App->admin');
$f3->route('GET @admin_login: /' . Config::ADMIN_URL . '/login', 'App\LocoForm\Infrastructure\Controllers\App->auth');
$f3->route('POST @admin_login_action: /' . Config::ADMIN_URL . '/login', 'App\LocoForm\Infrastructure\Controllers\App->authAction');
$f3->route('GET @admin_logout: /' . Config::ADMIN_URL . '/logout', 'App\LocoForm\Infrastructure\Controllers\App->logout');

//-- api routes --------------------------------------------------------------------------------------------------------

$f3->run();