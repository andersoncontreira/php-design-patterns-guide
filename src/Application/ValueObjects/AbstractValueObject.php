<?php

declare(strict_types=1);


namespace Application\ValueObjects;


use Application\Utils\ObjectUtils;

abstract class AbstractValueObject implements ValueObjectInterface
{
    /**
     * @throws \ReflectionException
     */
    public function __construct(array $data = null)
    {
        $this->populate($data);
    }

    /**
     * @throws \ReflectionException
     */
    public function populate(array $data = null)
    {
        if ($data) {
            ObjectUtils::populate($this, $data);
        }

    }
}
