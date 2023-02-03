<?php

namespace App\Presenters;

use App\Services\Components\LoginCheck\LoginCheckFactory;
use App\Services\Components\LoginForm\LoginForm;
use App\Services\Components\LoginForm\LoginFormFactory;

class LoginPresenter extends BasePresenter
{

    private LoginFormFactory $loginFormFactory;

    public function __construct(LoginCheckFactory $loginCheckFactory, LoginFormFactory $loginFormFactory)
    {
        parent::__construct($loginCheckFactory);
        $this->loginFormFactory = $loginFormFactory;
    }

    protected function createComponentLoginForm(): LoginForm {
        return $this->loginFormFactory->create();
    }
}