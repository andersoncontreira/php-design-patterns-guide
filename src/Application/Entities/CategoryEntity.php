<?php

declare(strict_types=1);


namespace Application\Entities;


class CategoryEntity extends AbstractEntity
{
    /**
     * Common fields
     */
    public int $active;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public \DateTime $deletedAt;
    public string $uuid;

}
