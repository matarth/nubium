<?php

namespace App\Services\Components\LoginForm;

use Nette\Application\AbortException;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;

class LoginForm extends Form
{

    private User $user;

    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;

        $this->addEmail('email', 'Email');
        $this->addPassword('password', 'Heslo');
        $this->addSubmit('submit', 'Přihlásit se');
        $this->onSuccess[] = [$this, 'onSuccess'];
    }

    /**
     * @param LoginForm $form
     * @param mixed[] $data
     * @return void
     * @throws AbortException
     * @throws AuthenticationException
     */
    public function onSuccess(LoginForm $form, array $data): void
    {
        $this->user->login($data['email'], $data['password']);
        $this->getPresenter()?->redirect('Articles:default');
    }
}