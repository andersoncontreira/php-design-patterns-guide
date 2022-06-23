<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Application\Reports\Datasources;



use Application\Reports\Datasources\DatabaseDatasource;
use Application\Repositories\MySQL\ProductRepository;
use Application\Tests\Unit\AbstractUnitTestCase;
use Application\Tests\Unit\Mocks\Illuminate\Database\DatabaseManagerMock;
use Illuminate\Database\DatabaseManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DatabaseDatasourceTest extends AbstractUnitTestCase
{

    protected DatabaseDatasource $instance;
    protected DatabaseManager $manager;
    protected ProductRepository $repository;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->manager = (new DatabaseManagerMock($this->logger))->getObjectWithMockDependencies();
        $this->repository = new ProductRepository($this->manager, $this->logger);
    }

    public function testGetData()
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, null)
        );

        $this->instance = new DatabaseDatasource($this->repository);
        $data = $this->instance->getData();
        self::assertIsArray($data);
    }
}
