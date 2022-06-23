<?php

declare(strict_types=1);


namespace Application\Reports\Factories;



use Application\Reports\Decorators\HtmlReportDecorator;
use Application\Reports\Formatter\HtmlReportFormatter;
use Application\Reports\Interfaces\ReportDecoratorInterface;
use Application\Reports\Interfaces\ReportFactoryInterface;
use Application\Reports\Interfaces\ReportFormatterInterface;

class HtmlReportFactory implements ReportFactoryInterface
{


    public function createFormatter(array $data): ReportFormatterInterface
    {
        return new HtmlReportFormatter($data);
    }

    public function createDecorator(): ReportDecoratorInterface
    {
        return new HtmlReportDecorator();
    }
}
