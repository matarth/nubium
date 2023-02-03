<?php

namespace App\Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class ChangePasswordForm extends Form
{

    public function __construct(){
        parent::__construct();

        $this->addPassword('old_password', 'Staré heslo:');
        $this->addPassword('new_password1', 'Nové heslo:');
        $this->addPassword('new_password2', 'Kontrola nového hesla:');
        $this->addSubmit('submit', 'Změnit');

    }
}