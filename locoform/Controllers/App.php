<?php

namespace App\LocoForm\Controllers;

use App\LocoForm\Model\Form;

class App
{

    public function start(\Base $f3, array $args = []): void
    {
        echo 'start';
    }

    public function form(\Base $f3, array $args = []): void
    {
        echo 'form from controller';
        echo "<p>".$f3->VERB."</p>";
        echo "<p>".$args['formCode']."</p>";

        $form = new Form($args['formCode'],'some name');
        $form->save();

        echo "<p>".$form->getId()."</p>";

    }

    public function fillForm(\Base $f3, array $args = []): void
    {
        echo 'fillForm from controller';
        echo "<p>".$f3->VERB."</p>";
        echo "<p>".$args['formCode']."</p>";
    }

    public function page(\Base $f3, array $args = []): void
    {
        echo 'page from controller';
        echo "<p>".$f3->VERB."</p>";
        echo "<p>form code: ".$args['formCode']."</p>";
        echo "<p>page code: ".$args['pageCode']."</p>";
    }

    public function auth(\Base $f3, array $args = []): void
    {
        echo 'auth';
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