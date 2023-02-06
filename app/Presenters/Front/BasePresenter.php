<?php

namespace App\Presenters\Front;

use App\Services\Components\LoginCheck\LoginCheck;
use App\Services\Components\LoginCheck\LoginCheckFactory;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{

    protected const itemsPerPage = 3;
    protected LoginCheckFactory $loginCheckFactory;

    public function __construct(LoginCheckFactory $loginCheckFactory)
    {
        $this->loginCheckFactory = $loginCheckFactory;
    }

    protected function createComponentLoginCheck(): LoginCheck
    {
        return $this->loginCheckFactory->create();
    }

}