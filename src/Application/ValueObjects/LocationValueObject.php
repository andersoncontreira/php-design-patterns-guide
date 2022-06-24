<?php

declare(strict_types=1);


namespace Application\ValueObjects;


class LocationValueObject extends AbstractValueObject
{
    public string $street;
    public string $city;
    public string $state;
    public string $zip;

    /**
     * Common fields
     */
    public int $active;
    public string $createdAt;
    public string $updatedAt;
    public string $deleteddAt;
    public string $uuid;
}
