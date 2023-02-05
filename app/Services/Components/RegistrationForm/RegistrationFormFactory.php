<?php

namespace App\Services\Components\RegistrationForm;

use App\Services\Factory\UserFactory;
use App\Services\Repository\UserRepository;

class RegistrationFormFactory
{

    private UserFactory $userFactory;
    private UserRepository $userRepository;

    public function __construct(UserFactory $userFactory, UserRepository $userRepository)
    {

        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
    }

    public function create(): RegistrationForm
    {
        return new RegistrationForm($this->userFactory, $this->userRepository);
    }

}