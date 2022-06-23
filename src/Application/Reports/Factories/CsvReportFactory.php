<?php

declare(strict_types=1);


namespace Application\Reports\Factories;



use Application\Reports\Decorators\CsvReportDecorator;
use Application\Reports\Formatter\CsvReportFormatter;
use Application\Reports\Formatter\XmlReportFormatter;
use Application\Reports\Interfaces\ReportDecoratorInterface;
use Application\Reports\Interfaces\ReportFactoryInterface;
use Application\Reports\Interfaces\ReportFormatterInterface;

class CsvReportFactory implements ReportFactoryInterface
{


    public function createFormatter(array $data): ReportFormatterInterface
    {
        return new CsvReportFormatter($data);
    }

    public function createDecorator(): ReportDecoratorInterface
    {
        return new CsvReportDecorator();
    }
}
