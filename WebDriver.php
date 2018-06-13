<?php

class WebDriver extends \Robo\Task\Base\Exec
{
    /**
     * @var int
     */
    private $port;

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

        return new \Robo\Result(
            $this,
            $exitCode !== null ? $exitCode : \Robo\ResultData::EXITCODE_OK,
            $resultData->getMessage(),
            $resultData->getData()
        );
    }
}
