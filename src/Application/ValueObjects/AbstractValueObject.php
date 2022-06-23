<?php

declare(strict_types=1);


namespace Application\ValueObjects;


use Application\Utils\ObjectUtils;
use ReflectionClass;

abstract class AbstractValueObject implements ValueObjectInterface
{

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
