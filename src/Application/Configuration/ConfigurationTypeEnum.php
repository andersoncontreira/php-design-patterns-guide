<?php

declare(strict_types=1);


namespace Application\Configuration;


class ConfigurationTypeEnum
{
    const app = 'app';
    const database = 'database';

    protected static array $map = [
        'app' => ApplicationConfiguration::class,
        'database' => DatabaseConfiguration::class
    ];

    public static function getConfiguration($name)
    {
        if (in_array($name, array_keys(self::$map))) {
            return self::$map[$name];
        } else {
            return null;
        }
    }
}
