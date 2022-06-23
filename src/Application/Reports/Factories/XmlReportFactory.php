<?php

declare(strict_types=1);


namespace Application\Reports\Factories;



use Application\Reports\Decorators\XmlReportDecorator;
use Application\Reports\Formatter\XmlReportFormatter;
use Application\Reports\Interfaces\ReportDecoratorInterface;
use Application\Reports\Interfaces\ReportFactoryInterface;
use Application\Reports\Interfaces\ReportFormatterInterface;

class XmlReportFactory implements ReportFactoryInterface
{


    public function createFormatter(array $data): ReportFormatterInterface
    {
        return new XmlReportFormatter($data);
    }

    public function createDecorator(): ReportDecoratorInterface
    {
        return new XmlReportDecorator();
    }
}
