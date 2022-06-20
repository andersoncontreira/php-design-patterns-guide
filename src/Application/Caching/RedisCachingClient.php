<?php

declare(strict_types=1);

namespace Application\Caching;

use Predis\Client;

class RedisCachingClient
{
    private Client $client;

    /**
     * CacheClientFacade constructor.
     *
     * @param Client|null $cacheClient
     * @param null $parameters
     * @param null $options
     */
    public function __construct(Client $cacheClient = null, $parameters = null, $options = null)
    {
        if ($cacheClient == null) {
            $this->client = new Client($parameters, $options);
        } else {
            $this->client = $cacheClient;
        }
    }

    /**
     * @return Client
     */
    public function getCacheClient(): Client
    {
        return $this->client;
    }
}
