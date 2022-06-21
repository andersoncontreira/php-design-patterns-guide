<?php

declare(strict_types=1);


namespace Application\Factories\Report;


use Application\Factories\ReportFactory;
use Application\Interfaces\Reports\ReportDatasourceInterface;
use Application\Interfaces\Reports\ReportFormatterInterface;
use Application\Interfaces\Reports\ReportProcessorInterface;

class JsonReportFactory implements ReportFactory
{

    public function createDatasource(): ReportDatasourceInterface
    {
        // TODO: Implement createDatasource() method.
    }


    public function createFormatter(): ReportFormatterInterface
    {
        // TODO: Implement createFormatter() method.
    }
}
