<?php

namespace App\Services\Components\LoginForm;

use Nette\Security\User;

class LoginFormFactory
{

    private User $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    public function create(): LoginForm
    {
        return new LoginForm($this->user);
    }

}