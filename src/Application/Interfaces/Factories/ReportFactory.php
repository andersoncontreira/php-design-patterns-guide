<?php

declare(strict_types=1);

namespace Application\Factories;


use Application\Interfaces\Reports\ReportDatasourceInterface;
use Application\Interfaces\Reports\ReportFormatterInterface;

interface ReportFactory
{
    public function createDatasource(): ReportDatasourceInterface;
    public function createFormatter(): ReportFormatterInterface;
}

