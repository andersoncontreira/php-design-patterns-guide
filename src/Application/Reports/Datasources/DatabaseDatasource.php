<?php

declare(strict_types=1);


namespace Application\Reports\Datasources;


use Application\Interfaces\Reports\ReportDatasourceInterface;

class DatabaseDatasource implements ReportDatasourceInterface
{

    public function __construct()
    {

    }

    public function getData(): array
    {
        return [];
    }
}
