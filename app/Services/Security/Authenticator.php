<?php

namespace App\Services\Security;

use App\Services\Repository\UserRepository;
use Nette\Security\AuthenticationException;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

class Authenticator implements \Nette\Security\Authenticator
{

    private UserRepository $userRepository;
    private Passwords $passwords;

    public function __construct(UserRepository $userRepository, Passwords $passwords)
    {

        $this->userRepository = $userRepository;
        $this->passwords = $passwords;
    }

    function authenticate(string $userEmail, string $password): IIdentity
    {
        $user = $this->userRepository->getUserByEmail($userEmail);
        if ($user === null) {
            throw new AuthenticationException("User $userEmail not found", 401);
        }

        if($this->passwords->verify($password . $userEmail, $user->getPassword())) {

            return new SimpleIdentity(
                $user->getId(),
                'authenticated',
                ['entity' => $user]
            );
        }
        else{
            throw new AuthenticationException("Bad login password combination", 401);
        }
    }
}