<?php

declare(strict_types=1);


namespace Application\Configuration;


class ConfigurationTypeEnum
{
    const app = ApplicationConfiguration::class;
    const database = DatabaseConfiguration::class;

    public static function getConfiguration($name)
    {
        $reflection = new \ReflectionClass(self::class);
        $array = $reflection->getConstants();
        if (in_array($name, array_keys($array))) {
            return $reflection->getConstant($name);
        } else {
            return null;
        }
    }
}
