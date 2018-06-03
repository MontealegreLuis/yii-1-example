<?php
class SiteCest
{
    public function viewHomePage(AcceptanceTester $I)
    {
        $I->am('guest');
        $I->lookForwardTo('view the home page');

        $I->amOnPage('/');
        $I->see('Welcome');
    }
    
    public function cannotContactSupportWithAnEmptyMessage(AcceptanceTester $I)
    {
        $I->am('customer');
        $I->wantTo('contact customer support');
        $I->lookForwardTo('explain my problem to them via email');

        $I->amOnPage('?r=site/contact');

        $I->see('Contact Us');
        $I->seeElement('[name="ContactForm[name]"]');

        $I->fillField('[name="ContactForm[name]"]','tester');
        $I->fillField('[name="ContactForm[email]"]','tester@example.com');
        $I->fillField('[name="ContactForm[subject]"]','test subject');
        $I->click('input[type="submit"]');

        $I->wait(.5);

        $I->see('Body cannot be blank.');
    }       
}
