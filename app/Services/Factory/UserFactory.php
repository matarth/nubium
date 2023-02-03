<?php

namespace App\Services\Factory;

use App\Entity\User;
use App\Services\Components\RegistrationForm\RegistrationForm;
use DateTime;
use Nette\Database\Table\ActiveRow;
use Nette\Security\Passwords;

class UserFactory
{

    private Passwords $passwords;

    public function __construct(Passwords $passwords)
    {

        $this->passwords = $passwords;
    }

    public function createFromDbRow(ActiveRow $user): User
    {

        try {
            return new User(
                $user->id,
                $user->uuid,
                $user->name,
                $user->email,
                $user->password,
                $user->last_online,
                $user->date_of_registration
            );
        } catch(\Exception $e){
            throw $e; // TODO dohledat spravnou exception
        }

    }

    public function createFromRegistrationForm(RegistrationForm $form): User
    {
        $formData = $form->getHttpData();
        return new User(
            0,
            sha1($formData['email']),
            $formData['name'],
            $formData['email'],
            $this->passwords->hash($formData['password1'] . $formData['email']),
            new DateTime(),
            new DateTime()
        );
    }

}