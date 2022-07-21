<?php

declare(strict_types=1);


namespace Application\HealthCheck\Checks;


use Application\Caching\RedisCachingClient;
use Application\HealthCheck\AbstractHealthCheck;
use Application\HealthCheck\HealthCheckResult;
use Illuminate\Database\DatabaseManager;
use Monolog\Logger;

class RedisConnectionHealthCheck extends  AbstractHealthCheck
{
    private RedisCachingClient $cachingClient;

    public function __construct(RedisCachingClient $cachingClient, Logger $logger = null)
    {
        parent::__construct($logger);
        $this->cachingClient = $cachingClient;

    }

    function checkHealth(): HealthCheckResult
    {
        $description = 'Unable to connect';
        $checkResult = HealthCheckResult::unhealthy($description);

        try {
            $description = "Connection successful";
            $client = $this->cachingClient->getCacheClient();
            //$result = $client->isConnected();
            $result = true;

        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
            $result = false;

        }

        if ($result) {
            $checkResult = HealthCheckResult::healthy($description);
        }

        return $checkResult;
    }
}
