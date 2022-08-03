<?php

namespace Application\Services\Product;

use Application\Services\ServiceInterface;

interface ListProductServiceInterface extends ServiceInterface
{
    /**
     * List of entities
     * @return array
     */
    public function getEntities(): array;


}
