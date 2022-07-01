<?php

declare(strict_types=1);


namespace Application\ValueObjects;


use Application\Utils\ObjectUtils;

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

//        $reflection = new \ReflectionClass(get_class($this));
//        foreach ($data as $key => $value) {
//            if (is_object($value) || is_array($value)) {
//                try {
//                    if ($reflection->hasProperty($key)) {
//                        $property = $reflection->getProperty($key);
//                        $property->getType();
//                    }
//                } catch (\Exception $e) {
//
//                }
//
//            }
//        }
    }
}
