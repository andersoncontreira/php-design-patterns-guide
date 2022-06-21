<?php

declare(strict_types=1);


namespace Application\Reports\Formatter;


use Application\Interfaces\Reports\ReportFormatterInterface;

/**
 * Pattern Family: Creational
 * Pattern Name: AbstractFactory
 * Group: ReportFactory
 */
class JsonReportFormatter implements ReportFormatterInterface
{

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function format(): string
    {
        return json_encode($this->data);
    }

}
