<?php

declare(strict_types=1);


namespace Application\Tests\Component\Application\Repositories\MySQL;


use Application\Repositories\MySQL\ProductRepository;
use Application\Tests\Component\AbstractComponentTestCase;
use Illuminate\Database\DatabaseManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Component Test
 */
class ProductRepositoryTest extends AbstractComponentTestCase
{
    /**
     * @var ProductRepository
     */
    protected ProductRepository $instance;
    /**
     * @var DatabaseManager
     */
    protected $manager;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->manager = $this->container->get('db');
        $this->instance = $this->container->get(ProductRepository::class);
    }

    /**
     * @dataProvider getTestListData
     * @param $where
     * @param $fields
     * @param $offset
     * @param $limit
     * @param $sortBy
     * @param $orderBy
     * @return void
     */
    public function testList($where = null, $fields = null, $offset=null, $limit=null, $sortBy=null, $orderBy=null)
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode(func_get_args()))
        );

        $result = $this->instance->list($where, $fields, $offset, $limit, $sortBy, $orderBy);

        //var_dump($result);

        self::assertNotNull($result);
        self::assertIsArray($result);
    }

    /**
     * @return array[]
     */
    public function getTestListData(): array
    {
        $where = null;
        $fields = '*';
        $offset=0;
        $limit=10;
        $sortBy=null;
        $orderBy=null;
        return [
            [$where, $fields, $offset, $limit, $sortBy, $orderBy],
            [$where, 'id, uuid', $offset, 1, $sortBy, $orderBy]
        ];
    }

}
