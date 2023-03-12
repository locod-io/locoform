<?php

namespace App\LocoForm\Infrastructure\Controllers;

use App\locoform\Infrastructure\Config;

class App extends BaseController
{

    public function start(\Base $f3, array $args = []): void
    {
        echo 'start';
    }

    public function auth(\Base $f3, array $args = []): void
    {
        new \Session(NULL, 'CSRF');
        $isLoggedIn = $f3->get('SESSION.is_logged_in');
        if ($isLoggedIn) {
            $f3->reroute('@admin', false);
        } else {
            $f3->copy('CSRF', 'SESSION.csrf_token');
            $f3->set('CSRF', $f3->CSRF);
            $f3->set('PAGE_TITLE', 'Login');
            $f3->set('APP_STYLESHEETS', $this->getStylesheets($f3, ['styles']));
            $f3->set('APP_JAVASCRIPTS', $this->getJavascripts($f3, ['login']));

            echo \Template::instance()->render(Config::APP_RELATIVE_DIR . 'locoform/Infrastructure/Templates/login.html');
        }
    }

    public function authAction(\Base $f3, array $args = []): void
    {
        new \Session();
        $session_token = $f3->get('SESSION.csrf_token');
        $token = $f3->get('POST.csrf_token');
        $passcode = $f3->get('POST.locoform_passcode');

        if (empty($token)
            || empty($session_token)
            || empty($passcode)
            || $token !== $session_token) {
            $f3->reroute('@admin_login', false);
        } else {
            if (sha1($passcode) === Config::ADMIN_HASH_CODE) {
                $f3->set('SESSION.is_logged_in', true);
                $f3->set('SESSION.timestamp', time());
                $f3->reroute('@admin', false);
            } else {
                $f3->clear('SESSION');
                $f3->reroute('@admin_login', false);
            }
        }
    }

    public function logout(\Base $f3, array $args = []): void
    {
        $f3->clear('SESSION');
        $f3->reroute('@admin_login', false);
    }

    public function admin(\Base $f3, array $args = []): void
    {
        new \Session();
        $isLoggedIn = $f3->get('SESSION.is_logged_in');
        if ($isLoggedIn) {
            echo 'admin dashboard from controller';
        } else {
            $f3->reroute('@admin_login', false);
        }
    }

}