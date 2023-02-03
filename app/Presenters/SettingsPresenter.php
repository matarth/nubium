<?php

namespace App\Presenters;

use App\Components\ChangePasswordForm\ChangePasswordForm;
use App\Components\ChangePasswordForm\ChangePasswordFormFactory;
use App\Components\LoginCheck\LoginCheckFactory;
use App\Entity\User;
use App\Repository\UserRepository;
use Nette\Security\Passwords;

class SettingsPresenter extends BasePresenter
{

    private User $userEntity;
    private Passwords $passwords;
    private UserRepository $userRepository;
    private ChangePasswordFormFactory $changePasswordFormFactory;

    public function __construct(LoginCheckFactory $loginCheckFactory, Passwords $passwords, UserRepository $userRepository, ChangePasswordFormFactory $changePasswordFormFactory)
    {
        parent::__construct($loginCheckFactory);
        $this->passwords = $passwords;
        $this->userRepository = $userRepository;
        $this->changePasswordFormFactory = $changePasswordFormFactory;
    }

    public function startup()
    {
        parent::startup();
        if(!$this->user->isLoggedIn()){
            $this->flashMessage('Musíte se nejdříve přihlásit.');
            $this->redirect('Articles:default');
        }

        $this->userEntity = $this->user->getIdentity()->getData()['entity'];

    }


    public function renderDefault(){

    }

    public function createComponentChangePasswordForm(){
        return $this->changePasswordFormFactory->create();
//        $form = new ChangePasswordForm();
//        $form->onSuccess[] = [$this, 'onSuccess'];
//        return $form;
    }
}