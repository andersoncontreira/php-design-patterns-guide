<?php

declare(strict_types=1);

namespace Application\Tests\Unit\Helpers;

use Application\Logger\ConsoleLogger;
use Monolog\Logger;

/**
 * Class ConsoleLoggerHelper
 */
class ConsoleLoggerHelper
{
    /**
     * @var Logger|null
     */
    protected static ?Logger $logger = null;

    /**
     * @return Logger
     */
    public static function getLogger(): Logger
    {
        if (self::$logger === null) {
            self::$logger = new ConsoleLogger();
        }

        return self::$logger;
    }
}
