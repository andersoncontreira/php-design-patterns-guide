<?php

declare(strict_types=1);


namespace Application\Tests\Component\Application\Reports\Datasources;



use Application\Reports\Datasources\DatabaseDatasource;
use Application\Repositories\MySQL\ProductRepository;
use Application\Tests\Component\AbstractComponentTestCase;
use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DatabaseDatasourceTest extends AbstractComponentTestCase
{

    protected DatabaseDatasource $instance;
    protected $manager;
    protected ProductRepository $repository;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->manager = $this->container->get('db');
        $this->repository = $this->container->get(ProductRepository::class);
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
