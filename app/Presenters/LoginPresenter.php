<?php

namespace App\Presenters;

use App\Components\LoginCheck\LoginCheckFactory;
use App\Components\LoginForm;
use App\Repository\UserRepository;
use Nette\Security\User;

class LoginPresenter extends BasePresenter
{

    protected function createComponentLoginForm(): LoginForm {
         $form = new LoginForm();
         $form->onSuccess[] = [$this, 'onSuccess'];
         return $form;
    }

    public function onSuccess(LoginForm $form, $data){
        try {
            $this->user->login($data['email'], $data['password']);
        } catch (\Exception $e) {
            throw $e;
        };
    }

}