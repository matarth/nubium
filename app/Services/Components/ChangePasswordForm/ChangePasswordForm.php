<?php

namespace App\Services\Components\ChangePasswordForm;

use App\Services\Repository\UserRepository;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;
use Nette\Security\User;

class ChangePasswordForm extends Form
{

    private Passwords $passwords;
    private UserRepository $userRepository;
    private User $user;

    public function __construct(Passwords $passwords, UserRepository $userRepository, User $user)
    {
        parent::__construct();

        $this->passwords = $passwords;
        $this->userRepository = $userRepository;
        $this->user = $user;

        $this->addPassword('old_password', 'Staré heslo:')->setRequired();
        $this->addPassword('new_password1', 'Nové heslo')->setRequired()->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků', 3);
        $this->addPassword('new_password2', 'Kontrola nového hesla:');
        $this->addSubmit('submit', 'Změnit');
        $this->onSuccess[] = [$this, 'onSuccess'];
    }

    /**
     * @param ChangePasswordForm $form
     * @param mixed[] $data
     * @return void
     * @throws AuthenticationException
     */
    public function onSuccess(ChangePasswordForm $form, array $data): void
    {

        if(!$this->user->isLoggedIn()) {
            throw new AuthenticationException("Unauthorized", 401);
        }

        $user = $this->user->getIdentity()?->getData()['entity'];
        $presenter = $this->getPresenter();

        if($data['new_password1'] !== $data['new_password2']) {
            $presenter?->flashMessage('Hesla se neshodují', 'error');
            return;
        }

        if(!$this->passwords->verify($data['old_password'] . $user->getEmail(), $user->getPassword())) {
            $presenter?->flashMessage('Neplatné heslo', 'error');
            return;
        }

        $newPasswordHash = $this->passwords->hash($data['new_password1'] . $user->getEmail());
        $user->setPassword($newPasswordHash);
        $this->userRepository->updateUser($user);

        $presenter?->flashMessage('Heslo úspěšně změneno. ', 'info');
        return;
    }
}