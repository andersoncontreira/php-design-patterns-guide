<?php

declare(strict_types=1);


namespace Application\Tests\Component\Application\Reports\Datasources;



use Application\Reports\Datasources\DatabaseDatasource;
use Application\Repositories\ProductRepository;
use Application\Tests\Component\AbstractComponentTestCase;

class DatabaseDatasourceTest extends AbstractComponentTestCase
{

    protected DatabaseDatasource $instance;
    protected $connection;

    public function setUp(): void
    {
        parent::setUp();
        $this->connection = $this->container->get('db');
    }

    public function testGetData()
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, null)
        );

        $sampleFile = APP_ROOT . '/tests/Datasources/reports/datasources/books.datasource.json';

        $repository = new ProductRepository();

        $this->instance = new DatabaseDatasource($repository);
        $data = $this->instance->getData();
        self::assertIsArray($data);
    }
}
