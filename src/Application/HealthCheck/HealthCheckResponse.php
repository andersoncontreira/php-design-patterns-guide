<?php

declare(strict_types=1);


namespace Application\HealthCheck;


use Application\Enums\HealthStatus;
use Application\Http\ApiResponse;
use Monolog\Logger;

class HealthCheckResponse extends ApiResponse
{
    public string $status;
    public int $totalDuration;
    private int $duration;
    private array $entries;



    public function __construct(Logger $logger)
    {
        parent::__construct($logger);
        $this->statusCode = 200;
        $this->status = HealthStatus::HEALTHY;
        $this->totalDuration = 0;
        $this->duration = 0;
        $this->entries = [];
    }

    public function getResponse($statusCode = null)
    {
        if ($statusCode == null) {
            if ($this->status == HealthStatus::UNHEALTHY) {
                $this->statusCode = 503;
            } else if ($this->status == HealthStatus::DEGRADED) {
                $this->statusCode = 424;
            }
        } else {
            $this->statusCode = $statusCode;
        }

        $headers = $this->headers;

        # # update entries
        # self.entries["self"] = {
        #     "status": self.self_status,
        #     "duration": self.duration,
        #     "tags": []
        # }

//        $this->entries = array_merge($this->entries, $this->data);
        $this->entries[] = $this->data;
        $body = [
            "status" => $this->status,
            "total_duration" => $this->totalDuration,
            "entries" => $this->entries
        ];

        if (in_array('Content-Type', array_keys($headers)) && $headers['Content-Type'] == 'application/json') {
            return response()->json($body, $this->statusCode, $this->headers);
        } else {
            return response($body, $this->statusCode, $this->headers);
        }

    }
}
