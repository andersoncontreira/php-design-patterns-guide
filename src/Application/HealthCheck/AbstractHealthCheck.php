<?php

declare(strict_types=1);


namespace Application\HealthCheck;


use Application\Factories\LoggerFactory;
use Application\Logger\ConsoleLogger;
use Monolog\Logger;

abstract class AbstractHealthCheck
{
    protected Logger $logger;

    /**
     *
     * @param $logger
     */
    protected function __construct(Logger $logger = null) {
        if ($logger == null) {
            //TODO converter para singleton
            $logger = LoggerFactory::factory(LoggerFactory::CONSOLE, APP_NAME);
        }
        $this->logger = $logger;
    }

    abstract function checkHealth(): HealthCheckResult;
}
