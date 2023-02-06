<?php


namespace Acceptance;

use Tests\Support\AcceptanceTester;

class RegistrationCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/registration');
    }

    // tests
    public function tryThatRegistrationPageWorks(AcceptanceTester $I)
    {
        $I->seeResponseCodeIs(200);
    }

    public function tryThatRegistrationWorks(AcceptanceTester $I){
        $I->fillField('email', 'test3@test.test');
        $I->fillField('name', 'test3');
        $I->fillField('password1', '1234');
        $I->fillField('password2', '1234');
        $I->click('Odeslat');
        $I->seeResponseCodeIs(200);
        $I->canSeeInSource('Uživatel uložen');
    }

    // NOT WORKING DUE TO SQLITE3 AUTO_INCREMENT
/*    public function tryThatSecondRegistrationFails(AcceptanceTester $I){
        $I->fillField('email', 'test4@test.test');
        $I->fillField('name', 'test3');
        $I->fillField('password1', '1234');
        $I->fillField('password2', '1234');
        $I->click('Odeslat');

        $I->amOnPage('/registration');
        $I->fillField('email', 'test4@test.test');
        $I->fillField('name', 'test3');
        $I->fillField('password1', '1234');
        $I->fillField('password2', '1234');
        $I->click('Odeslat');
        $I->canSeeInSource('Nepodařilo se uložit uživatele');

    }*/
}
