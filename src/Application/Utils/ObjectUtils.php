<?php

declare(strict_types=1);


namespace Application\Utils;

use ReflectionClass;

/**
 * Class ObjectUtils
 *
 * Helper to do object operations
 */
class ObjectUtils
{
    /**
     * Method toArray
     *
     * Converte uma entidade em um array
     *
     * @param $object
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public static function toArray(object $object)
    {
        $class = get_class($object);

        if ($class == \stdClass::class) {
            $data = json_decode(json_encode($object), true);
        } else {
            $data = [];
            $reflection = new ReflectionClass($class);
            $properties = $reflection->getProperties();
            foreach ($properties as $property) {
                $property->setAccessible(true);
                if($property->isInitialized($object)) {
                    $name = $property->getName();
                    $value = $property->getValue($object);

                    if (is_object($value)) {
                        $data[$name] = self::toArray($value);
                    } else {
                        $data[$name] = $value;
                    }
                }
            }
        }


        return $data;
    }

    public static function toJson(object $object) {
        return json_encode(self::toArray($object));
    }

    /**
     * @throws \ReflectionException
     */
    public static function populate(object $object, array $data)
    {
        $class = get_class($object);
        $reflection = new ReflectionClass($class);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            if (array_key_exists($name, $data)) {
                // not null
                if ($data[$name]) {
                    try {
                        $property->setValue($object, $data[$name]);
                    } catch (\Throwable $e) {
                        //TODO recuperar erros
                    }
                }

            }
        }
    }
}
