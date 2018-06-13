<?php

class WebDriver extends \Robo\Task\Base\Exec
{
    /**
     * @var int
     */
    private $port;

    /**
     * @var int
     */
    private $availabilityTimeout = 5;

    /**
     * @param string $command
     */
    public function __construct($command)
    {
        if (strpos($command, 'exec ') !== 0) {
            $command = sprintf('exec %s', $command);
        }

        parent::__construct($command);
    }

    public function port($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return \Robo\Result
     * @throws Exception
     */
    public function run()
    {
        $this->option('url-base', 'wd/hub', '=');
        $this->option('port', $this->port, '=');

        $process = new \Symfony\Component\Process\Process($this->getCommand());

        $resultData = $this->execute($process);
        $exitCode = $resultData->getExitCode();

        if (!$this->ensurePortReadiness($this->port, $this->availabilityTimeout)) {
            throw new \Exception(
                sprintf('Failed to ensure that web-driver is ready on %s', $this->port)
            );
        }

        return new \Robo\Result(
            $this,
            $exitCode !== null ? $exitCode : \Robo\ResultData::EXITCODE_OK,
            $resultData->getMessage(),
            $resultData->getData()
        );
    }

    private function ensurePortReadiness($port, $timeout, $bindAddress = '127.0.0.1')
    {
        $stepLimit = $timeout * 10;

        for ($step = 0; $step < $stepLimit; $step++) {
            if (!$socket = @fsockopen($bindAddress, $port, $errorCode, $errorMessage, 0)) {
                usleep(100000);

                continue;
            }

            return true;
        }

        return false;
    }
}
