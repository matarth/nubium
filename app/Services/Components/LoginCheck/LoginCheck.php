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
        $this->template->isLoggedIn = $this->user->isLoggedIn();
        $this->template->user = $this->user?->getIdentity()?->getData()['entity'];

        $this->template->render(__DIR__ . '/loginCheck.latte');

    }
}