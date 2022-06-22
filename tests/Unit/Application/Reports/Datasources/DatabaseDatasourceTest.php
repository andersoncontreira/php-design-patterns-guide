<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Application\Reports\Datasources;



use Application\Reports\Datasources\DatabaseDatasource;
use Application\Repositories\ProductRepository;
use Application\Tests\Unit\AbstractUnitTestCase;

class DatabaseDatasourceTest extends AbstractUnitTestCase
{

    protected DatabaseDatasource $instance;

    public function testGetData()
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, null)
        );

        $sampleFile = APP_ROOT . '/tests/Datasources/reports/datasources/books.datasource.json';

//        $repository = (new ProductRepositoryMock())->getObjectWithDependencies();
//
//        $this->instance = new DatabaseDatasource($repository);
//        $data = $this->instance->getData();
//        self::assertIsArray($data);
    }
}
