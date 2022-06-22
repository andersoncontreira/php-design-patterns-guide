<?php

declare(strict_types=1);


namespace Application\Reports\Datasources;


use Application\Interfaces\Reports\ReportDatasourceInterface;

class FileDatasource implements ReportDatasourceInterface
{

    private string $sourceName;

    public function __construct($fileName)
    {
        $this->sourceName = $fileName;
    }

    public function getData():array
    {
        $data = file_get_contents($this->sourceName);
        return json_decode($data ,true);
    }
}
