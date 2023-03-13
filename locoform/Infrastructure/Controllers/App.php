<?php

namespace App\LocoForm\Infrastructure\Controllers;

use App\locoform\Infrastructure\Config;

class App extends BaseController
{

    public function start(\Base $f3, array $args = []): void
    {
        $f3->set('PAGE_TITLE', 'Welcome');
        $f3->set('APP_STYLESHEETS', $this->getStylesheets($f3, ['styles']));
        $f3->set('APP_JAVASCRIPTS', $this->getJavascripts($f3, []));
        echo \Template::instance()->render(Config::APP_RELATIVE_DIR . 'locoform/Infrastructure/Templates/start.html');
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
        $password = $f3->get('POST.locoform_password');

        if (empty($token)
            || empty($session_token)
            || empty($password)
            || $token !== $session_token) {
            $f3->reroute('@admin_login', false);
        } else {
            if (sha1($password) === Config::ADMIN_HASH_CODE) {
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
        new \Session();
        $f3->set('SESSION.is_logged_in', false);
        $f3->clear('SESSION');
        $f3->reroute('@admin_login', false);
    }

    public function admin(\Base $f3, array $args = []): void
    {
        new \Session();
        $isLoggedIn = $f3->get('SESSION.is_logged_in');
        if ($isLoggedIn) {
            $f3->set('PAGE_TITLE', 'Dashboard');
            $f3->set('APP_STYLESHEETS', $this->getStylesheets($f3, ['styles']));
            $f3->set('APP_JAVASCRIPTS', $this->getJavascripts($f3, ['main']));

            echo \Template::instance()->render(Config::APP_RELATIVE_DIR . 'locoform/Infrastructure/Templates/admin.html');
        } else {
            $f3->reroute('@admin_login', false);
        }
    }

    public function adminFormDetail(\Base $f3, array $args = []): void
    {
        echo "form detail";
    }

    public function adminFormEntries(\Base $f3, array $args = []): void
    {
        echo "form entries";
    }

}