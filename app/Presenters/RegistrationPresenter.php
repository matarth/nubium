<?php

namespace App\Presenters;

use App\Services\Components\LoginCheck\LoginCheckFactory;
use App\Services\Components\RegistrationForm\RegistrationFormFactory;
use Nette\Application\UI\Form;

final class RegistrationPresenter extends BasePresenter
{

    private RegistrationFormFactory $registrationFormFactory;

    public function __construct(LoginCheckFactory $loginCheckFactory, RegistrationFormFactory $registrationFormFactory)
    {
        parent::__construct($loginCheckFactory);
        $this->loginCheckFactory = $loginCheckFactory;
        $this->registrationFormFactory = $registrationFormFactory;
    }

    protected function createComponentRegistrationForm(): Form
    {
        return $this->registrationFormFactory->create();
    }
}