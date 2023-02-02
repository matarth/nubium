<?php

namespace Tests\Acceptance;

use PHPUnit\Framework\Assert;
use Tests\Support\AcceptanceTester;

class RegistrationPageCest
{
    public function _before(AcceptanceTester $I)
    {

    }

    // tests
    public function tryToTestRegistrationPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/registration');
        dumpe($I->grabPageSource());

        $I->fillField('email', 'xx@xyz.cz');
        $I->canSeeResponseCodeIs(205);
    }
}
