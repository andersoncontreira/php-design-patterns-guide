<?php

declare(strict_types=1);


namespace Application\Services\Product\V1;


use Application\Application;
use Application\Services\Product\AbstractProductService;
use Application\Services\Product\ListProductServiceInterface;
use Application\Utils\OrderUtils;
use Application\Utils\PaginationUtils;
use Application\Utils\QueryUtils;
use Application\Validators\Product\ListProductValidator;

class ListProductService extends AbstractProductService implements ListProductServiceInterface
{

    public function __construct(Application $application)
    {
        parent::__construct($application);
        $this->validator = $application->get(ListProductValidator::class);
    }

    public function execute(array $data=null): bool
    {
        $result = true;

        list($where, $fields, $offset, $limit, $sortBy, $orderBy) =
            QueryUtils::extractParams($data, $this->productRepository);

        try {
            $list = $this->productRepository->list($where, $fields, $offset, $limit, $sortBy, $orderBy);
            var_dump('list', $list);
        } catch (\Exception $exception) {
            $this->logger->error($exception);
            $result = false;
        }

        return $result;
    }

    public function getEntities(): array
    {
        $list = [];
        return $list;
    }
}
