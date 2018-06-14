<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */

class ExampleCest
{
    public function tryFillingGoogleSearchInput(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->fillField('q', 'hello');

        $I->assertEquals('hello', $I->grabValueFrom('q'));
    }
}
