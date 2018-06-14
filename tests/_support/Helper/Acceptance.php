<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
namespace Helper;

class Acceptance extends \Codeception\Module
{
    /**
     * @var array
     */
    private $webDriverConfigUpdates = [];

    /**
     * @throws \Codeception\Exception\ModuleConfigException
     * @throws \Codeception\Exception\ModuleException
     */
    public function _initialize()
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');

        $this->webDriverConfigUpdates = array_filter([
            'port' => getenv('CC_WEB_DRIVER_PORT')
        ]);

        $webDriver->_reconfigure($this->webDriverConfigUpdates);
    }

    /**
     * @param \Codeception\TestCase $test
     * @throws \Codeception\Exception\ModuleConfigException
     * @throws \Codeception\Exception\ModuleException
     */
    public function _before(\Codeception\TestCase $test)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');

        $webDriver->_reconfigure($this->webDriverConfigUpdates);
    }
}
