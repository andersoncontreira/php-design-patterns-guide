<?php

declare(strict_types=1);


namespace Application\Reports;


use Application\Enums\ReportTypeEnum;
use Application\Reports\Factories\CsvReportFactory;
use Application\Reports\Factories\HtmlReportFactory;
use Application\Reports\Factories\JsonReportFactory;
use Application\Reports\Factories\XmlReportFactory;
use Application\Reports\Interfaces\ReportDatasourceInterface;
use Application\Reports\Interfaces\ReportFactoryInterface;

abstract class AbstractReport {
    protected ReportDatasourceInterface $datasource;
    protected array $data;
    protected array $factoryMap = [
        ReportTypeEnum::json => JsonReportFactory::class,
        ReportTypeEnum::xml => XmlReportFactory::class,
        ReportTypeEnum::csv => CsvReportFactory::class,
        ReportTypeEnum::html => HtmlReportFactory::class
    ];

    public function __construct(ReportDatasourceInterface $datasource)
    {
        $this->datasource = $datasource;
    }
    abstract public function generate(): AbstractReport;

    /**
     * @throws \Exception
     */
    public function output($type = ReportTypeEnum::json): string
    {
        if (in_array($type, array_keys($this->factoryMap))) {

            $factoryClass = $this->factoryMap[$type];
            /** @var ReportFactoryInterface $factory */
            $factory = new $factoryClass();

        } else {
            throw new \Exception("Invalid report type requested ($type)");
        }
        $decorator = $factory->createDecorator();
        $data = $decorator->decorate($this->data);
        $formatter = $factory->createFormatter($data);

        return $formatter->format();
    }
}
