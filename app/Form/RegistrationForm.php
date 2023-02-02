<?php

namespace App\Form;

use Nette\Application\UI\Form;

class RegistrationForm extends Form
{

    public function __construct() {
        $this->addEmail('email', 'Email');
        $this->addText('name', 'Jméno');
        $this->addPassword('password1', 'Heslo');
        $this->addPassword('password2', 'Heslo2');
        $this->addSubmit('submit', 'Odeslat');
    }

}