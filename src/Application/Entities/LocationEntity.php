<?php

declare(strict_types=1);


namespace Application\Entities;


use Application\Utils\ObjectUtils;

class LocationEntity  extends AbstractEntity
{
    public string $street;
    public string $city;
    public string $state;
    public string $zip;

    /**
     * Common fields
     */
    public int $active;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public \DateTime $deletedAt;
    public string $uuid;

}
