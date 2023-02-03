<?php

declare(strict_types=1);


namespace Application\Entities;


use Application\Enums\GenderEnum;

class CustomerEntity extends AbstractEntity
{
    public GenderEnum $gender;
    public string $title;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $username;
    public string $password;
    public LocationEntity $entity;

    /**
     * Common fields
     */
    public int $active;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public \DateTime $deletedAt;
    public string $uuid;


}
