<?php

declare(strict_types=1);


namespace Application\Entities;


use ReflectionClass;

class ProductEntity extends AbstractEntity implements EntityInterface
{
    public int $id;
    public string $name;
    public SupplierEntity $supplier;
    public int $sku;
    public string $description;
    public CategoryEntity $category;

    /**
     * Common fields
     */
    public int $active;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public \DateTime $deleteddAt;
    public string $uuid;

}
