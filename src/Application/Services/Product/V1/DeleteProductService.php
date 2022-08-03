<?php

declare(strict_types=1);


namespace Application\Services\Product\V1;


use Application\Services\Product\AbstractProductService;
use Application\Services\Product\DeleteProductServiceInterface;

class DeleteProductService extends AbstractProductService implements DeleteProductServiceInterface
{

    public function execute(array $data=null): bool
    {
        // TODO: Implement execute() method.
    }
}
