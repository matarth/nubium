<?php

namespace App\Components;

use Nette\Application\UI\Form;

class LoginForm extends Form
{

    public function __construct()
    {
        $this->addEmail('email', 'Email');
        $this->addPassword('password', 'Heslo');
        $this->addSubmit('submit', 'Přihlásit se');
    }

}