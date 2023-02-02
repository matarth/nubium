<?php

namespace App\Repository;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Factory\UserFactory;
use Nette\Database\Explorer;

class UserRepository
{

    private Explorer $db;
    private UserFactory $userFactory;

    public function __construct(Explorer $db, UserFactory $userFactory){

        $this->db = $db;
        $this->userFactory = $userFactory;
    }

    /**
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): ?User
    {
        $user = $this->db
            ->table('user')
            ->where('email', $email)
            ->fetch();

        if($user === null) {
            return null;
        }

        return $this->userFactory->createFromDbRow($user);
    }

    public function saveNewUser(User $user){
        $userArray = $user->toArray();
        unset($userArray['id']);
        $this->db->table('user')->insert($userArray);
    }
}