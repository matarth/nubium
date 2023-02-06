<?php


namespace tests\Acceptance;

use Tests\Support\AcceptanceTester;

class ArticlesCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }

    // tests
    public function seeThatArticlesAreShown(AcceptanceTester $I)
    {
        $I->canSeeResponseCodeIs(200);
        $I->canSeeInSource('PPPperex11');
    }

    public function seeThatPaginatorIsShown(AcceptanceTester $I)
    {
        $I->canSeeElement('.paginator');
        $I->canSeeElement('.page-number');
    }

    public function tryPaginator(AcceptanceTester $I){
        $I->click('.page-number');
        $I->seeResponseCodeIs(200);
        $I->canSeeInSource('PPPperex7');
    }

    public function tryThatSortingWorks(AcceptanceTester $I){
        $I->canSeeInSource('Perex ↓');
        $I->click('Perex ↓');
        $I->seeResponseCodeIs(200);
        $I->canSeeInSource('PPPperex7');
    }

}
