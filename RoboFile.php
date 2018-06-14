<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */

use Tivie\OS;
use Vaimo\ChromeDriverExample as Lib;

class RoboFile extends \Robo\Tasks
{
    /**
     * @var OS\Detector
     */
    private $osDetector;

    /**
     * @var array
     */
    private $chromeDriverBinaries = [
        'linux' => 'bin/chromedriver',
        'mac' => 'bin/chromedriver',
        'windows' => 'bin/chromedriver.exe'
    ];

    public function __construct()
    {
        $this->osDetector = new OS\Detector();
    }

    /**
     * @param array $opts
     * @option string $use Name of the browser setup used for running the tests.
     * @throws \Exception
     */
    public function runTests($opts = ['use' => 'chrome-headless'])
    {
        $port = $this->allocatePort();

        $this->taskWebDriver()
            ->port($port)
            ->option('incognito')
            ->background()
            ->run();

        $this->taskTestRunner()
            ->port($port)
            ->suite('acceptance')
            ->env($opts['use'])
            ->run();
    }

    /**
     * @return Lib\WebDriver
     */
    private function taskWebDriver()
    {
        $osName = $this->getOperationSystemName();

        /** @var Lib\WebDriver $driver */
        $driver = $this->task(Lib\WebDriver::class, $this->chromeDriverBinaries[$osName]);

        return $driver;
    }

    /**
     * @return Lib\Codecept
     */
    private function taskTestRunner()
    {
        /** @var Lib\Codecept $testRunner */
        $testRunner = $this->task(Lib\Codecept::class, 'bin/codecept');

        return $testRunner;
    }

    private function allocatePort($bindAddress = '127.0.0.1')
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_bind($socket, $bindAddress, 0);
        socket_getsockname($socket, $ip, $port);

        return $port;
    }

    private function getOperationSystemName()
    {
        switch ($this->osDetector->getType()) {
            case OS\MACOSX:
                return 'mac';
            case OS\LINUX:
                return 'linux';
            default:
                return 'windows';
        }
    }
}
