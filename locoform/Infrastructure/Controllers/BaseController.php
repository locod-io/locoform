<?php

namespace App\LocoForm\Infrastructure\Controllers;

use App\locoform\Infrastructure\Config;

class BaseController
{

    public function getStylesheets(\Base $f3, array $entries): array
    {
        $result = [];
        $manifest = $f3->get('APP_MANIFEST');
        foreach ($entries as $entry) {
            $result[] = '/' . $manifest['src/css/' . $entry . '.css']['file'];
        }
        return $result;
    }

    public function getJavascripts(\Base $f3, array $entries): array
    {
        $result = [];
        $manifest = $f3->get('APP_MANIFEST');
        foreach ($entries as $entry) {
            $result[] = '/' . $manifest['src/' . $entry . '.js']['file'];
        }
        return $result;
    }

}