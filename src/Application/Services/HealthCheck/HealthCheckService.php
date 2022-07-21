<?php

declare(strict_types=1);


namespace Application\Services\HealthCheck;


use Application\Enums\HealthStatus;
use Application\HealthCheck\AbstractHealthCheck;
use Application\HealthCheck\HealthCheckResponse;
use Application\Services\ServiceInterface;
use Monolog\Logger;

class HealthCheckService
{
    protected array $entries = [];
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function addCheck($name, AbstractHealthCheck $check, array $tags, array  $args = null)
    {
        $this->entries[] = [
            'name' => $name,
            'healthCheck' => $check,
            'tags' => $tags,
            'args' => $args
        ];
    }

    public function getResult()
    {
        $serviceStatus = HealthStatus::HEALTHY;
        $totalDuration = microtime();

        $result = [
            "status"=> $serviceStatus,
            "total_duration" => $totalDuration,
            "entries" => []
        ];

        foreach ($this->entries as $entry) {
            $name = $entry["name"];
            $healthCheck = $entry["healthCheck"];
            $tags = $entry["tags"];
            $args = $entry["args"];
            $status = HealthStatus::UNHEALTHY;
            $start = microtime();
            $check = null;
            try {
                if ($healthCheck instanceof AbstractHealthCheck) {
                    $check = $healthCheck->checkHealth();
                }

                if ($check != null) {
                    $status = $check->status;
                }

            } catch (\Exception $exception) {
                $this->logger->error($exception->getMessage());
            }

            $end = microtime();
            $duration = 0;
//            $duration = ($end - $start);
//            $totalDuration = $totalDuration + $duration;

            $result["entries"][$name] = [
                "status" => $status,
                "duration" => $duration,
                "tags" => $tags
            ];

            if ($status != HealthStatus::HEALTHY) {
                if ($serviceStatus == HealthStatus::HEALTHY) {
                    $serviceStatus = HealthStatus::DEGRADED;
                } else {
                    $serviceStatus = HealthStatus::UNHEALTHY;
                }
            }

        }

        # update variables
        $result["status"] = $serviceStatus;
        // TODO camelCase
        $result["total_duration"] = $totalDuration;

        return $result;
    }

    public function getResponse()
    {
        $result = $this->getResult();
        $response = new HealthCheckResponse($this->logger);
        $response->status = $result['status'];
        //$response->totalDuration = $result['total_duration'];
        $response->setData($result['entries']);
        return $response->getResponse();
    }


}
