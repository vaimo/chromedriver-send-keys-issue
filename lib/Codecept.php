<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
namespace Vaimo\ChromeDriverExample;

class Codecept extends \Robo\Task\Testing\Codecept
{
    const WEB_DRIVER_PORT = 'CC_WEB_DRIVER_PORT';

    public function port($port)
    {
        $this->envVars([
            \Vaimo\ChromeDriverExample\Codecept::WEB_DRIVER_PORT => $port
        ]);

        return $this;
    }
}
