<?php

declare(strict_types=1);


namespace Application\Entities;


use ReflectionClass;

class OrderEntity extends AbstractEntity implements EntityInterface
{
    public int $id;
    public string $orderCode;
    public string $currency;
    public float $amount;
    public CustomerEntity $customer;

    /**
     * Common fields
     */
    public int $active;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public \DateTime $deletedAt;
    public string $uuid;



}
