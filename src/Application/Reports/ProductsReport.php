<?php

declare(strict_types=1);


namespace Application\Reports;


use Application\Reports\Interfaces\ReportDatasourceInterface;

class ProductsReport extends AbstractReport {
    protected ReportDatasourceInterface $datasource;
    protected array $data;

    public function generate(): AbstractReport
    {
        $this->data = $this->datasource->getData();
        // Do somenthing here to prepare the report

        return $this;
    }
}
