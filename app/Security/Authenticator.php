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

    public function __construct(UserRepository $userRepository, Passwords $passwords){

        $this->passwords = $passwords;
        $this->userRepository = $userRepository;
    }

    function authenticate(string $userEmail, string $password): IIdentity
    {
        try {
            $user = $this->userRepository->getUserByEmail($userEmail);
        } catch (\Exception $e){
            throw new AuthenticationException($e->getMessage());
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