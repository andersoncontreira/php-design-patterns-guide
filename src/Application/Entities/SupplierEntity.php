<?php

declare(strict_types=1);


namespace Application\Entities;


class SupplierEntity extends AbstractEntity
{
    /**
     * Common fields
     */
    public int $active;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public \DateTime $deleteddAt;
    public string $uuid;

}
