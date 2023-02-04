<?php

namespace App\Services\Components\RegistrationForm;

use App\Services\Factory\UserFactory;
use App\Services\Repository\UserRepository;
use Nette\Application\UI\Form;
use Nette\Utils\Validators;

class RegistrationForm extends Form
{
    private UserFactory $userFactory;
    private UserRepository $userRepository;

    public function __construct(UserFactory $userFactory, UserRepository $userRepository)
    {
        parent::__construct();
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;


        $this->addEmail('email', 'Email');
        $this->addText('name', 'Jméno');
        $this->addPassword('password1', 'Heslo');
        $this->addPassword('password2', 'Heslo2');
        $this->addSubmit('submit', 'Odeslat');
        $this->onSuccess[] = [$this, 'formSuccess'];
    }

    /**
     * @param  mixed[] $data
     * @return void
     * @throws \App\Exception\UserNotFoundException
     * @throws \Nette\Application\AbortException
     */
    public function formSuccess(RegistrationForm $form, array $data): void
    {
        $presenter = $this->getPresenter();
        if(Validators::isEmail($data['email'])
            && ($data['password1'] === $data['password2'])
            && $this->userRepository->getUserByEmail($data['email']) === null
        ) {
            $this->userRepository->saveNewUser($this->userFactory->createFromRegistrationForm($form));
            $presenter->flashMessage('Uživatel uložen', 'info');
            $presenter->redirect('Login:default');
        }
        else{
            $presenter->flashMessage('Nepodařilo se uložit uživatele', 'error');
        }
    }

}