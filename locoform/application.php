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

//-- database setup ----------------------------------------------------------------------------------------------------

R::ext('locoDispense', function ($type) {
    return R::getRedBean()->dispense($type);
});

R::setup(
    'mysql:host=' . Config::DB_SERVER . ':' . Config::DB_SERVER_PORT . ';dbname=' . Config::DB_NAME,
    Config::DB_USER,
    Config::DB_PWD
);

//-- framework setup ---------------------------------------------------------------------------------------------------

$f3 = \Base::instance();
$f3->set('AUTOLOAD', Config::APP_RELATIVE_DIR . 'locoform/');
$f3->set('CACHE', 'folder=' . Config::APP_RELATIVE_DIR . 'locoform/' . Config::DATA_FOLDER . '/_tmp/cache/');
$f3->set('TEMP', Config::APP_RELATIVE_DIR . 'locoform/' . Config::DATA_FOLDER . '/_tmp/templates/');
$f3->set('APP_RELATIVE_DIR', Config::APP_RELATIVE_DIR);
$f3->set('APP_NAME', Config::APP_NAME);
$f3->set('LOCOFORM_PUBLIC_FOLDER', Config::LOCOFORM_PUBLIC_FOLDER);

//-- frontend setup ----------------------------------------------------------------------------------------------------

$_manifest = json_decode(file_get_contents(dirname($_SERVER['SCRIPT_FILENAME']) . '/assets/manifest.json'), TRUE);
$f3->set('APP_MANIFEST', $_manifest);

//-- form routes -------------------------------------------------------------------------------------------------------

$f3->route('GET @form: /@formCode', 'App\LocoForm\Infrastructure\Controllers\Form->form');
$f3->route('GET @page: /p/@formSlug/@pageSlug', 'App\LocoForm\Infrastructure\Controllers\Form->page');
$f3->route('POST @page: /p/@formSlug/@pageSlug', 'App\LocoForm\Infrastructure\Controllers\Form->fillPage');

//-- application routes ------------------------------------------------------------------------------------------------

$f3->route('GET @start: /', 'App\LocoForm\Infrastructure\Controllers\App->start');
$f3->route('GET @admin: /' . Config::ADMIN_URL, 'App\LocoForm\Infrastructure\Controllers\App->admin');
$f3->route('GET @admin_detail: /@formSlug' . Config::ADMIN_URL, 'App\LocoForm\Infrastructure\Controllers\App->adminFormDetail');
$f3->route('GET @admin_detail_entries: /@formSlug/entries' . Config::ADMIN_URL, 'App\LocoForm\Infrastructure\Controllers\App->adminFormEntries');
$f3->route('GET @admin_login: /' . Config::ADMIN_URL . '/login', 'App\LocoForm\Infrastructure\Controllers\App->auth');
$f3->route('POST @admin_login_action: /' . Config::ADMIN_URL . '/login', 'App\LocoForm\Infrastructure\Controllers\App->authAction');
$f3->route('GET @admin_logout: /' . Config::ADMIN_URL . '/logout', 'App\LocoForm\Infrastructure\Controllers\App->logout');

//-- api routes --------------------------------------------------------------------------------------------------------

$f3->run();