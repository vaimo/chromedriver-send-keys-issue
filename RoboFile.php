<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
include 'WebDriver.php';

use Tivie\OS;

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
        'max' => 'bin/chromedriver',
        'windows' => 'bin/chromedriver.exe'
    ];

    public function __construct()
    {
        $this->osDetector = new OS\Detector();
    }

    /**
     * @throws Exception
     */
    public function runTests()
    {
        $osName = $this->getOperationSystemName();
        $port = $this->allocatePort();

        $this->taskWebDriver()
            ->port($port)
            ->option('incognito')
            ->background()
            ->run();

        $this->taskCodecept()
            ->envVars(['CC_WEB_DRIVER_PORT' => $port])
            ->suite('acceptance')
            ->env(sprintf('chrome---%s', $osName))
            ->run();
    }

    /**
     * @return \WebDriver
     */
    private function taskWebDriver()
    {
        $osName = $this->getOperationSystemName();

        /** @var \WebDriver $driver */
        $driver = $this->task(WebDriver::class, $this->chromeDriverBinaries[$osName]);

        return $driver;
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
