<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
namespace Vaimo\ChromeDriverExample;

use Vaimo\ChromeDriverExample\Interfaces\WebDriverInterface;

class Codecept extends \Robo\Task\Testing\Codecept
{
    public function port($port)
    {
        $this->envVars([
            'CC_WEB_DRIVER_PORT' => $port
        ]);

        return $this;
    }
}
