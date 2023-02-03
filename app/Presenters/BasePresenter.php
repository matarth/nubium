<?php

namespace App\Presenters;

use App\Components\LoginCheck\LoginCheck;
use App\Components\LoginCheck\LoginCheckFactory;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{

    protected const itemsPerPage = 5;
    protected LoginCheckFactory $loginCheckFactory;

    public function __construct(LoginCheckFactory $loginCheckFactory)
    {
        $this->loginCheckFactory = $loginCheckFactory;
    }

    protected function createComponentLoginCheck(): LoginCheck{
        return $this->loginCheckFactory->create();
    }

}