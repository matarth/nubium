<?php

namespace App\Services\Repository;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Services\Factory\UserFactory;
use Nette\Database\Explorer;

class UserRepository extends BaseRepository
{

    private UserFactory $userFactory;

    public function __construct(Explorer $db, UserFactory $userFactory)
    {

        parent::__construct($db->table('user'));

        $this->userFactory = $userFactory;
    }

    /**
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): ?User
    {
        $user = $this->db
            ->where('email', $email)
            ->fetch();

        if($user === null) {
            return null;
        }

        return $this->userFactory->createFromDbRow($user);
    }

    public function saveNewUser(User $user): void
    {
        $userArray = $user->toArray();
        unset($userArray['id']);
        $this->db->insert($userArray);
    }

    public function updateUser(User $user): void
    {
        $this->db
            ->where('id', $user->getId())
            ->update($user->toArray());
    }
}