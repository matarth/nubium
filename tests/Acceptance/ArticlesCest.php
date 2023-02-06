<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class ArticlesCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        dd($I->grabPageSource());
        $I->canSeeResponseCodeIs(200);
    }
}
