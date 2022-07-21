<?php

declare(strict_types=1);


namespace Application\Enums;


class HealthStatus
{
    // all available
    const HEALTHY = 'healthy';
    // partial
    const DEGRADED = 'degraded';
    // unavailable
    const UNHEALTHY = 'unhealthy';
}
