<?php

declare(strict_types=1);


namespace Application\Entities;


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
    public \DateTime $deleteddAt;
    public string $uuid;

    public function populate(array $data)
    {
        // TODO: Implement populate() method.
    }
}
