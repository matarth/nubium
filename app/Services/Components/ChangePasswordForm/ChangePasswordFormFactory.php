<?php

namespace App\Services\Components\ChangePasswordForm;

use App\Services\Repository\UserRepository;
use Nette\Security\Passwords;
use Nette\Security\User;

class ChangePasswordFormFactory
{

    private Passwords $passwords;
    private UserRepository $userRepository;
    private User $user;

    public function __construct(Passwords $passwords, UserRepository $userRepository, User $user){

        $this->passwords = $passwords;
        $this->userRepository = $userRepository;
        $this->user = $user;
    }

    public function create(): ChangePasswordForm {
        return new ChangePasswordForm($this->passwords, $this->userRepository, $this->user);
    }


}