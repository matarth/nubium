<?php

namespace App\Security;

use App\Exception\AppException;
use App\Repository\UserRepository;
use Nette\Database\Explorer;
use Nette\Security\AuthenticationException;
use Nette\Security\IdentityHandler;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

class Authenticator implements \Nette\Security\Authenticator
{

    private UserRepository $userRepository;
    private Passwords $passwords;

    public function __construct(UserRepository $userRepository, Passwords $passwords){

        $this->userRepository = $userRepository;
        $this->passwords = $passwords;
    }

    function authenticate(string $userEmail, string $password): IIdentity
    {
        $user = $this->userRepository->getUserByEmail($userEmail);
        if ($user === null){
            throw new AuthenticationException("User $userEmail not found");
        }

        if($this->passwords->verify($password, $user->getPassword())){

            return new SimpleIdentity(
                $user->getId(),
                'authenticated',
                ['entity' => $user]
            );
        }
        else{
            throw new AuthenticationException("Bad login password combination");
        }
    }
}