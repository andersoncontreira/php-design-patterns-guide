<?php

declare(strict_types=1);

namespace Application\Factories;

use Application\Logger\ConsoleLogger;

class LoggerFactory
{
    const CONSOLE = 'console';

    /**
     * @param $mode
     * @param $name
     * @return ConsoleLogger
     */
    public static function factory($mode, $name): ConsoleLogger
    {
        switch ($mode) {
            default:
            case self::CONSOLE:
                $logger = new ConsoleLogger($name);
            break;
        }

        return $logger;
    }
}
