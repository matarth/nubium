<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{

    protected const itemsPerPage = 5;

    protected function createComponentLoginCheck(){

    }

}