<?php

namespace App\Presenters\Front;

use App\Entity\User;
use App\Services\Components\ChangePasswordForm\ChangePasswordForm;
use App\Services\Components\ChangePasswordForm\ChangePasswordFormFactory;
use App\Services\Components\LoginCheck\LoginCheckFactory;
use App\Services\Repository\UserRepository;
use Nette\Security\Passwords;

class SettingsPresenter extends BasePresenter
{

    private ChangePasswordFormFactory $changePasswordFormFactory;

    public function __construct(LoginCheckFactory $loginCheckFactory, ChangePasswordFormFactory $changePasswordFormFactory)
    {
        parent::__construct($loginCheckFactory);
        $this->changePasswordFormFactory = $changePasswordFormFactory;
    }

    public function startup()
    {
        parent::startup();
        if(!$this->user->isLoggedIn()) {
            $this->flashMessage('Musíte se nejdříve přihlásit.', 'error');
            $this->redirect('Articles:default');
        }
    }

    public function createComponentChangePasswordForm(): ChangePasswordForm
    {
        return $this->changePasswordFormFactory->create();
    }
}