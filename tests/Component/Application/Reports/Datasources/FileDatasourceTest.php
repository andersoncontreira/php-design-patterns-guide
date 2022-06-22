<?php

declare(strict_types=1);


namespace Application\Tests\Component\Application\Reports\Datasources;



use Application\Reports\Datasources\FileDatasource;
use Application\Tests\Component\AbstractComponentTestCase;

class FileDatasourceTest extends AbstractComponentTestCase
{

    protected FileDatasource $instance;

    public function testGetData()
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, null)
        );

        $sampleFile = APP_ROOT . '/tests/Datasources/reports/datasources/books.datasource.json';

        $this->instance = new FileDatasource($sampleFile);
        $data = $this->instance->getData();
        self::assertIsArray($data);
    }
}
