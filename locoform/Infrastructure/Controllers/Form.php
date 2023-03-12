<?php

namespace App\LocoForm\Infrastructure\Controllers;

use App\LocoForm\Domain\Model\Form as FormModel;

class Form extends BaseController
{

    public function form(\Base $f3, array $args = []): void
    {
        echo 'form from controller';
        echo "<p>".$f3->VERB."</p>";
        echo "<p>".$args['formCode']."</p>";

        $form = new FormModel($args['formCode'],'some name');
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

}