<?php

declare(strict_types=1);


namespace Application\HealthCheck;


use Application\Enums\HealthStatus;

class HealthCheckResult
{
    public string $status;
    public string $description;

    /**
     *
     * @param null $status
     * @param string|null $description
     */
    public function __construct($status = null, string $description = null)
    {
        if ($status == null) {
            $status = HealthStatus::UNHEALTHY;
        }
        $this->status = $status;
        $this->description = $description;
    }

    /**
     *
     * @param $description
     * @return HealthCheckResult
     */
    public static function healthy($description): HealthCheckResult
    {
        return new HealthCheckResult(HealthStatus::HEALTHY, $description);
    }

    /**
     *
     * @param $description
     */
    public static function unhealthy($description)
    {
        return new HealthCheckResult(HealthStatus::UNHEALTHY, $description);
    }

    /**
     *
     * @param $description
     */
    public static function degraded($description)
    {
        return new HealthCheckResult(HealthStatus::DEGRADED, $description);
    }
}
