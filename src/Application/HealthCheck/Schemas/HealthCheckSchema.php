<?php


use Application\Enums\HealthStatus;

/**
 * @OA\Schema(
 *      schema="EntrySchema"
 * )
 */
class EntrySchema {
    /**
     * @OA\Property(example="healthy")
     * @var string
     */
    public string $status = HealthStatus::HEALTHY;
    /**
     * @OA\Property(example="0:00:00.013737")
     * @var string
     */
    public string $duration;
    /**
     * @OA\Property(@OA\Items(type="string", example="db"))
     * @var array
     */
    public array $tags;
}


/**
 * @OA\Schema(
 *      schema="EntryData"
 * )
 */
class EntryData {
    /**
     * @OA\Property(ref="#/components/schemas/EntrySchema")
     * @var array
     */
    public array $name;
}

/**
 * @OA\Schema(
 *      schema="HealthCheckSchema",
 *      required={"status", "totalDuration", "entries"}
 * )
 */
class HealthCheckSchema{
    /**
     * @OA\Property(example="healthy")
     * @var string
     */
    public string $status = HealthStatus::HEALTHY;

    /**
     * @OA\Property(example="0:00:00.013737")
     * @var string
     */
    public string $totalDuration;

    /**
     * @OA\Property(@OA\Items(ref="#/components/schemas/EntryData"))
     * @var array
     */
    public array $entries;
}

/**
 * @OA\Schema(
 *      schema="DegradedCheckSchema",
 *      required={"status", "totalDuration", "entries"}
 * )
 */
class DegradedCheckSchema {
    /**
     * @OA\Property(example="degraded")
     * @var string
     */
    public string $status = HealthStatus::DEGRADED;
    /**
     * @OA\Property(example="0:00:00.013737")
     * @var string
     */
    public string $totalDuration;
    /**
     * @OA\Property(@OA\Items(ref="#/components/schemas/EntryData"))
     * @var array
     */
    public array $entries;
}

/**
 * @OA\Schema(
 *      schema="UnhealthyCheckSchema",
 *      required={"status", "totalDuration", "entries"}
 * )
 */
class UnhealthyCheckSchema {
    /**
     * @OA\Property(example="unhealthy")
     * @var string
     */
    public string $status = HealthStatus::UNHEALTHY;
    /**
     * @OA\Property(example="0:00:00.013737")
     * @var string
     */
    public string $totalDuration;
    /**
     * @OA\Property(@OA\Items(ref="#/components/schemas/EntryData"))
     * @var array
     */
    public array $entries;
}
