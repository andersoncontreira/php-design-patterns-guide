<?php

declare(strict_types=1);


namespace Application\Reports\Factories;


use Application\Reports\Decorators\JsonReportDecorator;
use Application\Reports\Formatter\JsonReportFormatter;
use Application\Reports\Interfaces\ReportDecoratorInterface;
use Application\Reports\Interfaces\ReportFactoryInterface;
use Application\Reports\Interfaces\ReportFormatterInterface;

class JsonReportFactory implements ReportFactoryInterface
{

    public function createFormatter(array $data): ReportFormatterInterface
    {
        return new JsonReportFormatter($data);

    }

    public function createDecorator(): ReportDecoratorInterface
    {
        return new JsonReportDecorator();
    }
}
