<?php

declare(strict_types=1);


namespace Application\ValueObjects;


class ProductValueObject extends AbstractValueObject
{
    public int $id;
    public string $name;
    public SupplierValueObject $supplier;
    public int $sku;
    public string $description;
    public CategoryValueObject $category;

    /**
     * Common fields
     */
    public int $active;
    public string $createdAt;
    public string $updatedAt;
    public string $deleteddAt;
    public string $uuid;

}
