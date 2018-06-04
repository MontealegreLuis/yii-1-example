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

        $I->fillField('[name="ContactForm[name]"]', 'tester');
        $I->fillField('[name="ContactForm[email]"]', 'tester@example.com');
        $I->fillField('[name="ContactForm[subject]"]', 'test subject');
        $I->click('input[type="submit"]');

        $I->wait(.5);

        $I->see('Body cannot be blank.');
    }

    public function loginLogoutFromSite(AcceptanceTester $I)
    {
        $I->am('customer');
        $I->wantTo('open and close my session');
        $I->lookForwardTo('login and logout from the site');

        $I->amOnPage('/');

        // test login process, including validation
        $I->click('Login');
        $I->wait(.25);

        $I->seeElement('[name="LoginForm[username]"]');
        $I->fillField('[name="LoginForm[username]"]', 'demo');
        $I->click('input[value="Login"]');
        $I->wait(.25);

        $I->see('Password cannot be blank');
        $I->fillField('[name="LoginForm[password]"]', 'demo');
        $I->click('input[value="Login"]');
        $I->wait(.25);
        $I->dontSee('Password cannot be blank');
        $I->see('Logout');

        // test logout process
        $I->dontSee('Login');
        $I->click('Logout (demo)');
        $I->wait(.25);
        $I->see('Login');
    }
}
