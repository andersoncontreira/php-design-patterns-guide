<?php

declare(strict_types=1);


namespace Component\Application\Facades;


use Application\Caching\RedisCachingClient;
use Application\Facades\HealthCheckManagerFacade;
use Application\Services\HealthCheck\HealthCheckService;
use Application\Tests\Component\AbstractComponentTestCase;
use Illuminate\Database\DatabaseManager;
use Monolog\Logger;

class HealthCheckManagerFacadeTestCase extends AbstractComponentTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $cachingClient = $this->app->get(RedisCachingClient::class);
        $databaseManager = $this->app->get(DatabaseManager::class);
        $healthCheckService = $this->app->get(HealthCheckService::class);
        $this->manager = new HealthCheckManagerFacade($this->logger, $cachingClient, $databaseManager, $healthCheckService);
    }

    public function testCheck()
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__,
                json_encode(func_get_args()))
        );

        var_dump('aq');
    }
}
