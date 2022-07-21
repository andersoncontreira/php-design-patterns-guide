<?php

declare(strict_types=1);


namespace Application\HealthCheck\Checks;


use Application\HealthCheck\AbstractHealthCheck;
use Application\HealthCheck\HealthCheckResult;
use Illuminate\Database\DatabaseManager;
use Monolog\Logger;

class MysqlConnectionHealthCheck extends  AbstractHealthCheck
{
    private DatabaseManager $manager;

    public function __construct(DatabaseManager $manager, Logger $logger = null)
    {
        parent::__construct($logger);
        $this->manager = $manager;

    }

    function checkHealth(): HealthCheckResult
    {
        $description = 'Unable to connect';
        $checkResult = HealthCheckResult::unhealthy($description);

        try {
            $result = true;
            $description = "Connection successful";
            $dbName = $this->manager->connection()->getDatabaseName();
            if ($dbName == null) {
                throw new \Exception('MySQL not connected');
            }
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
