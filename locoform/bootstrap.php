<?php

use \RedBeanPHP\R as R;
use App\LocoForm\Config;

R::ext('locoDispense', function( $type ){
    return R::getRedBean()->dispense( $type );
});

R::setup(
    'mysql:host='.Config::DB_SERVER.':'.Config::DB_SERVER_PORT.';dbname='.Config::DB_NAME,
    Config::DB_USER,
    Config::DB_PWD
);