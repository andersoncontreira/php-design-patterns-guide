<?php

namespace Application\Tests\Component\Application\Facades;

use Application\Exceptions\CustomException;
use Application\Exceptions\ValidatorException;
use Application\Facades\ProductManagerFacade;
use Application\Services\Product\V1\CreateProductService;
use Application\Services\Product\V1\DeleteProductService;
use Application\Services\Product\V1\ListProductService;
use Application\Services\Product\V1\UpdateProductService;
use Application\Tests\Component\AbstractComponentTestCase;
use Application\Utils\OrderUtils;
use Application\Utils\PaginationUtils;
use PHPUnit\Framework\TestCase;

class ProductManagerFacadeTestCase extends AbstractComponentTestCase
{
    protected ProductManagerFacade $facade;


    /**
     * @dataProvider getListDataProvider
     * @param $where
     * @param $offset
     * @param $limit
     * @param $orderBy
     * @param $sortBy
     * @param $fields
     * @param $expected
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function testList($where, $fields, $offset, $limit, $orderBy, $sortBy, $expected)
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__,
                json_encode(func_get_args()))
        );

        $listService = $this->container->get(ListProductService::class);
        $createService = $this->container->get(CreateProductService::class);
        $updateService = $this->container->get(UpdateProductService::class);
        $deleteService = $this->container->get(DeleteProductService::class);
        $entityConverter = null;

        $this->facade = new ProductManagerFacade(
            $listService, $createService, $updateService, $deleteService, $this->logger, $entityConverter);
        /** Debug Info */
        $this->facade->setDebug(true);

        $result = $this->facade->list($where, $fields, $offset, $limit, $orderBy, $sortBy);
        $exception = $this->facade->getException();
        if (!$expected) {
//            var_dump('$exception', $exception);
            self::assertInstanceOf(ValidatorException::class, $exception);
            self::assertNotEmpty($exception);
        } else {
//            var_dump('$result', $result);
            self::assertNotEmpty($result);
        }

    }

    /**
     * @return array[]
     */
    public function getListDataProvider(): array
    {
        $where=[];
        $offset=PaginationUtils::OFFSET;
        $limit=PaginationUtils::LIMIT;
        $orderBy=OrderUtils::ASC;
        $sortBy=null;
        $fields=[];

        return [
            [$where, $fields, $offset, $limit, $orderBy, $sortBy, true],
            [$where, null, $offset, $limit, $orderBy, null, true],
            [$where, null, $offset, $limit, $orderBy, 'tmp', false]
        ];
    }
}
