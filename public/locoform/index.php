<?php

require '../../vendor/autoload.php';

use App\LocoForm\Config;

$f3 = \Base::instance();

$f3->route('GET /',
    function () {
        echo 'Hello, world!';

        var_dump(Config::LOCOFORM_PUBLIC_FOLDER);

    }
);

$f3->run();
