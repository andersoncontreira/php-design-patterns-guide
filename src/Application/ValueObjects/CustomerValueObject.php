<?php

declare(strict_types=1);


namespace Application\ValueObjects;


use Application\Utils\ObjectUtils;

class CustomerValueObject extends AbstractValueObject
{
    public string $gender;
    public string $title;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $username;
    public string $password;
    public LocationValueObject $location;

    /**
     * Common fields
     */
    public int $active;
    public \DateTime $createdAt;
    public \DateTime $updatedAt;
    public \DateTime $deleteddAt;
    public string $uuid;

    /**
     * @return LocationValueObject
     */
    public function getLocation(): LocationValueObject
    {
        return $this->location;
    }

    public function populate(array $data = null)
    {
        parent::populate($data);

        //extra fields
        if (array_key_exists('location', $data)) {
            $location = new LocationValueObject();
            $location->populate($data['location']);
            $this->location = $location;
        }

        //TODO melhorar
        if (array_key_exists('name', $data)) {
            $name_array = $data['name'];
            $size = count($name_array);

            $title = '';
            $firstName = '';
            $lastName = '';
            if (array_key_exists(0, $name_array)) {
                $firstName = $name_array[0];
                if ($size > 1) {
                    $lastName = $name_array[$size-1];
                }
            } else if (array_key_exists('first', $name_array)){
                $title = $data['name']['title'];
                $firstName = $data['name']['first'];
                $lastName = $data['name']['last'];
            }

            $this->title = $title;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
        }
    }

}
