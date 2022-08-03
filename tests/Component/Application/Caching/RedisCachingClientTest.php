<?php

namespace Application\Tests\Component\Application\Caching;

use Application\Caching\RedisCachingClient;
use Predis\Client;
use Predis\Connection\ConnectionException;
use Predis\Connection\StreamConnection;
use Application\Tests\Component\AbstractComponentTestCase;

/**
 * Component test for RedisCachingClient
 * In this scenario we will test a real connection to redis running in local/docker environment
 */
class RedisCachingClientTest extends AbstractComponentTestCase
{
    protected RedisCachingClient $instance;

    /**
     * @dataProvider getDataForNewInstance
     * @param $cacheClient
     * @param $parameters
     * @param $options
     * @param $expectedResult
     * @return void
     */
    public function testNewInstance($cacheClient, $parameters, $options, $expectedResult)
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode(func_get_args()))
        );

        $instance = new RedisCachingClient($cacheClient, $parameters, $options);

        $client = $instance->getCacheClient();

        self::assertInstanceOf(Client::class, $client);

        $connection = $client->getConnection();
        self::assertInstanceOf(StreamConnection::class, $connection);


    }

    /**
     * @dataProvider getDataForNewInstance
     * @param $cacheClient
     * @param $parameters
     * @param $options
     * @param $expectedResult
     * @return void
     */
    public function testConnection($cacheClient, $parameters, $options, $expectedResult){
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode(func_get_args()))
        );
        $instance = new RedisCachingClient($cacheClient, $parameters, $options);

        $client = $instance->getCacheClient();
        self::assertInstanceOf(Client::class, $client);

        if (!$expectedResult) {
            self::expectException(ConnectionException::class);
            $client->connect();
        } else {
            $client->connect();
            self::assertEquals($expectedResult, $client->isConnected());
        }

    }

    /**
     * Data provider for redis tests
     * @return array[]
     */
    public function getDataForNewInstance(): array
    {
        $predis = new Client();
        $parameters = [];
        $options = [];
        $errorParameters = [
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 9999,
        ];
        return [
            [null, null, null, true],
            [$predis, null, null, true],
            [null, $parameters, $options, true],
            [null, $errorParameters, $options, false]
        ];
    }
}
