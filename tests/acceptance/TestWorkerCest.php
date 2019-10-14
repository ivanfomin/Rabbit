<?php

class TestWorkerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->fillField('Сообщение', 'Hello World');

        $I->click('Отправить');


        $I->see('Проверить');

    }

    public function tryToTest1(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->fillField('Сообщение', 'How are you?');

        $I->click('Отправить');

        $I->see('Проверить');

        $I->click('Проверить');

       //$I->see('Ваш запрос обрабатывается');


    }

    public function tryToTest2(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->fillField('Найти', '89');

        $I->click('Найти');

        $I->see('Ваш запрос How are you? обработан');

        $I->see('На главную');


    }
}
