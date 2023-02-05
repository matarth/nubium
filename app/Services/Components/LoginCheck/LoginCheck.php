<?php

namespace App\Services\Components\LoginCheck;

use Nette\Application\UI\Control;
use Nette\Security\User;

class LoginCheck extends Control
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function render(): void
    {
        $this->getTemplate()->isLoggedIn = $this->user->isLoggedIn();
        $this->getTemplate()->user = $this->user->getIdentity()?->getData()['entity'];
        $this->getTemplate()->setFile(__DIR__ . 'loginCheck.latte');
        $this->getTemplate()->render();
    }
}