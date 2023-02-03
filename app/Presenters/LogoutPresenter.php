<?php

namespace App\Presenters;

class LogoutPresenter extends BasePresenter
{

    public function actionDefault(){
        $this->user->logout();
        $this->flashMessage("Byli jste úspěšně odhlášeni.");
        $this->redirect('Articles:default');
    }

}