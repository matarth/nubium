<?php

namespace App\Presenters;

use App\Factory\UserFactory;
use App\Form\RegistrationForm;
use App\Repository\UserRepository;
use Nette\Application\UI\Form;
use Nette\Utils\Validators;

final class RegistrationPresenter extends BasePresenter
{

    private UserRepository $userRepository;
    private UserFactory $userFactory;

    public function __construct(UserRepository $userRepository, UserFactory $userFactory){

        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    public function startup()
    {
        parent::startup();
        Form::initialize();
    }

    protected function createComponentRegistrationForm(): Form
    {

        $form = new RegistrationForm();
        $form->onSuccess[] = [$this, 'formSuccess'];
        return $form;

    }

    public function formSuccess(RegistrationForm $form, $data): void
    {

        if(
            Validators::isEmail($data['email']) &&
            ($data['password1'] === $data['password2']) &&
            $this->userRepository->getUserByEmail($data['email']) === null
        )
        {
            $this->userRepository->saveNewUser($this->userFactory->createFromRegistrationForm($form));
            $this->flashMessage('Uživatel uložen', 'info');
            $this->redirect('default');
        }
        else{
            $this->flashMessage('Nepodařilo se uložit uživatele');
        }

    }

}