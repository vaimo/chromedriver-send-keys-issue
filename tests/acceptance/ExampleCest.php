<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */

class ExampleCest
{
    public function tryUsingGoogle(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->pressKey('[name="q"]', 'hello');

        $text = $I->grabValueFrom('[name="q"]');

        $I->assertEquals('hello', $text);
    }
}
