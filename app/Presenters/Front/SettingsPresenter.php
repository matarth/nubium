<?php

namespace App\Presenters\Front;

use App\Entity\User;
use App\Presenters\Front\BasePresenter;
use App\Services\Components\ChangePasswordForm\ChangePasswordFormFactory;
use App\Services\Components\LoginCheck\LoginCheckFactory;
use App\Services\Repository\UserRepository;
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
        if(!$this->user->isLoggedIn()) {
            $this->flashMessage('Musíte se nejdříve přihlásit.', 'error');
            $this->redirect('Articles:default');
        }

        $this->userEntity = $this->user->getIdentity()->getData()['entity'];

    }


    public function createComponentChangePasswordForm()
    {
        return $this->changePasswordFormFactory->create();
    }
}