<?php

declare(strict_types=1);


namespace Application\Facades;


use Application\Caching\RedisCachingClient;
use Application\HealthCheck\Checks\MysqlConnectionHealthCheck;
use Application\HealthCheck\Checks\RedisConnectionHealthCheck;
use Application\Services\HealthCheck\HealthCheckService;
use Illuminate\Database\DatabaseManager;
use Monolog\Logger;

/**
 *
 */
class HealthCheckManagerFacade implements FacadeInterface
{
    private HealthCheckService $healthCheckService;
    private Logger $logger;
    private DatabaseManager $databaseManager;
    private RedisCachingClient $cachingClient;

    public function __construct(Logger $logger, RedisCachingClient $cachingClient, DatabaseManager $databaseManager, HealthCheckService $healthCheckService)
    {
        $this->logger = $logger;
        $this->cachingClient = $cachingClient;
        $this->databaseManager = $databaseManager;
        $this->healthCheckService = $healthCheckService;
    }

    public function check() {
        //$this->healthCheckService->addCheck('self', new SelfConnectionHealthCheck($this->logger), []);
        $this->healthCheckService->addCheck('mysql', new MysqlConnectionHealthCheck($this->databaseManager, $this->logger), ["db", "rw"]);
        $this->healthCheckService->addCheck('redis', new RedisConnectionHealthCheck($this->cachingClient, $this->logger), ["cache"]);
        //TODO para dar supporter
//        $this->healthCheckService->addCheck('redis', function () {
//            return HealthCheckResult::healthy();
//        }, ["example"]);

        return $this->healthCheckService->getResponse();
    }
}
