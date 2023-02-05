<?php

namespace App\Presenters\Front;

use App\Presenters\Front\BasePresenter;

class LogoutPresenter extends BasePresenter
{

    public function actionDefault()
    {
        $this->user->logout();
        $this->flashMessage("Byli jste úspěšně odhlášeni.");
        $this->redirect('Articles:default');
    }

}