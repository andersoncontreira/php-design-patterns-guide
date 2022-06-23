<?php

require_once '../../tests/bootstrap.php';

use Application\Enums\ReportTypeEnum;
use Application\Reports\CustomersReport;
use Application\Reports\Datasources\DatabaseDatasource;
use Application\Reports\Datasources\FileDatasource;
use Application\Reports\ProductsReport;
use Application\Repositories\MySQL\ProductRepository;

$container = new Application\Application(APP_ROOT);

/** @var ProductRepository $repository */
$repository = $container->get(ProductRepository::class);
$datasource =  new DatabaseDatasource($repository);

$report = new ProductsReport($datasource);

$out = $report->generate()->output(ReportTypeEnum::xml);
print('xml' . PHP_EOL);
print($out . PHP_EOL);

$out = $report->output(ReportTypeEnum::json);
print('json' . PHP_EOL);
print($out . PHP_EOL);

$out = $report->output(ReportTypeEnum::csv);
print('csv' . PHP_EOL);
print($out . PHP_EOL);

$out = $report->output(ReportTypeEnum::html);
print('html' . PHP_EOL);
print($out . PHP_EOL);
print(PHP_EOL);

print('Other type of datasource');
print(PHP_EOL);
$filedatasource = new FileDatasource(APP_ROOT.'/samples/reports/datasources/customers.datasource.json');
$report = new CustomersReport($filedatasource);
$out = $report->generate()->output(ReportTypeEnum::xml);
print('xml' . PHP_EOL);
print($out . PHP_EOL);

$out = $report->output(ReportTypeEnum::json);
print('json' . PHP_EOL);
print($out . PHP_EOL);

