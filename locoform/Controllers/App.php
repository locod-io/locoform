<?php

namespace App\LocoForm\Controllers;

use App\LocoForm\Model\Form;

class App
{

    public function start(\Base $f3, array $args = []): void
    {
        echo 'start';
    }

    public function auth(\Base $f3, array $args = []): void
    {
        echo 'auth';
        echo '<br><br>';
        new \Session(NULL,'CSRF');
        echo $f3->CSRF; // token here

    }

    public function authAction(\Base $f3, array $args = []): void
    {
        echo 'auth Action';
        echo "<p>".$f3->VERB."</p>";
    }

    public function logout(\Base $f3, array $args = []): void
    {
        echo 'logout';
    }

    public function admin(\Base $f3, array $args = []): void
    {
        echo 'admin from controller';
    }

}