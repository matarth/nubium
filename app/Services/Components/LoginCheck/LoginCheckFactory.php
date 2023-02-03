<?php

namespace App\Services\Components\LoginCheck;

use Nette\Security\User;

class LoginCheckFactory
{

    private User $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function create(): LoginCheck {
        return new LoginCheck($this->user);
    }
}