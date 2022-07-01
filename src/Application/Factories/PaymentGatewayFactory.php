<?php

declare(strict_types=1);

namespace Application\Factories;

use Application\Application;
use Application\Caching\AbstractCachingClient;
use Application\Caching\RedisCachingClient;
use Application\Configuration\DatabaseConfiguration;
use Application\Enums\AcquirerEnum;
use Application\Enums\CachingTypeEnum;

class PaymentGatewayFactory
{

    public static function factory(Application $container, string $type = AcquirerEnum::CIELO): GatewayInterface
    {
        switch ($type) {
            default:
            case AcquirerEnum::CIELO:
                $configuration = $container->get(DatabaseConfiguration::class)->getConfiguration();
                break;
            case AcquirerEnum::PAYPAL:
                $configuration = $container->get(DatabaseConfiguration::class)->getConfiguration();
                break;
        }
        return $client;
    }
}
