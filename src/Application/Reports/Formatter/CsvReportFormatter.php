<?php

declare(strict_types=1);


namespace Application\Reports\Formatter;



use Application\Reports\Interfaces\ReportFormatterInterface;
use Application\Reports\ReportHelper;

/**
 * Pattern Family: Creational
 * Pattern Name: AbstractFactory
 * Group: ReportFactory
 */
class CsvReportFormatter implements ReportFormatterInterface
{

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function format(): string
    {
        $keys = ReportHelper::getKeys($this->data);
        $output = fopen("php://memory",'w');
        fputcsv($output, $keys);
        foreach($this->data as $item) {
            fputcsv($output, $item);
        }
        rewind($output);
        $content = stream_get_contents($output);
        fclose($output);

        return $content;

    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

}
