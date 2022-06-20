<?php

declare(strict_types=1);

namespace Application\Logger\Formatter;

use Monolog\Formatter\FormatterInterface;

/**
 * Class ConsoleFormatter
 *
 * Format log record for console output
 */
class ConsoleFormatter implements FormatterInterface
{
    /**
     * Method format
     *
     * @param array $record
     *
     * @return string
     */
    public function format(array $record): string
    {
        $message = $record['message'] ?? "";

        return "[{$record['level_name']}] {$message}" . PHP_EOL;
    }

    /**
     * Formats a set of log records.
     *
     * @param array $records A set of records to format
     *
     * @return mixed The formatted set of records
     */
    public function formatBatch(array $records)
    {
        return $this->format($records);
    }
}
