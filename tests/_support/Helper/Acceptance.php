<?php
namespace Helper;

class Acceptance extends \Codeception\Module
{
    /**
     * @var array
     */
    private $webDriverConfigUpdates = [];

    public function _initialize()
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');

        $this->webDriverConfigUpdates = array_filter([
            'port' => getenv('CC_WEB_DRIVER_PORT')
        ]);

        $webDriver->_reconfigure($this->webDriverConfigUpdates);
    }

    public function _before(\Codeception\TestCase $test)
    {
        /** @var \Codeception\Module\WebDriver $webDriver */
        $webDriver = $this->getModule('WebDriver');

        $webDriver->_reconfigure($this->webDriverConfigUpdates);
    }
}
