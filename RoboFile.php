<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
include 'WebDriver.php';

class RoboFile extends \Robo\Tasks
{
    /**
     * @throws Exception
     */
    public function runTests()
    {
        $port = $this->allocatePort();

        $this->taskWebDriver()
            ->port($port)
            ->option('incognito')
            ->background()
            ->run();

        $this->taskCodecept()
            ->envVars(['CC_WEB_DRIVER_PORT' => $port])
            ->suite('acceptance')
            ->env('chrome')
            ->run();
    }

    /**
     * @return \WebDriver
     */
    private function taskWebDriver()
    {
        /** @var \WebDriver $driver */
        $driver = $this->task(WebDriver::class, 'bin/chromedriver');

        return $driver;
    }

    private function allocatePort($bindAddress = '127.0.0.1')
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_bind($socket, $bindAddress, 0);
        socket_getsockname($socket, $ip, $port);

        return $port;
    }
}
