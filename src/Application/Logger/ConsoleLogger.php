<?php

declare(strict_types=1);

namespace Application\Logger;

use Application\Logger\Formatter\ConsoleFormatter;
use DateTimeZone;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Logger instance for console/stdout outputs
 */
class ConsoleLogger extends Logger
{
    public static int $level = Logger::DEBUG;

    protected $name = 'console';

    protected $timezone = 'America/Sao_Paulo';

    public function __construct(string $name = null, array $handlers = [], array $processors = [], ?DateTimeZone $timezone = null)
    {
        $level = Logger::toMonologLevel(self::$level);

        if ($name != null) {
            $this->name = $name;
        }
        if (empty($handlers)) {
            $stdout = new StreamHandler('php://output', $level);
            $stdout->setFormatter(new ConsoleFormatter());
            $handlers = [$stdout];
        }

        parent::__construct($this->name, $handlers, $processors, $timezone ?: new DateTimeZone($this->timezone));
    }
}
