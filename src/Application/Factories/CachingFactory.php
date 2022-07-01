<?php

declare(strict_types=1);

namespace Application\Factories;

use Application\Application;
use Application\Caching\AbstractCachingClient;
use Application\Caching\RedisCachingClient;
use Application\Configuration\DatabaseConfiguration;
use Application\Enums\CachingTypeEnum;

class CachingFactory
{

    public static function factory(Application $container, string $type = CachingTypeEnum::redis): AbstractCachingClient
    {
        switch ($type) {
            default:
            case CachingTypeEnum::REDIS:
                $configuration = $container->get(DatabaseConfiguration::class)->getConfiguration();
                $parameters = $configuration['redis']['default'];
                $options = [];
                $client = new RedisCachingClient(null, $parameters, $options);
                break;
        }
        return $client;
    }
}
