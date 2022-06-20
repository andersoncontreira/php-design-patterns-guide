<?php

namespace Application\Tests\Unit\Application\Caching;

use Application\Caching\RedisCachingClient;
use Application\Tests\Unit\AbstractUnitTestCase;
use Predis\Client;
use Predis\Connection\ConnectionException;
use Predis\Connection\StreamConnection;
use Application\Tests\Unit\Mocks\Predis\ClientMock;

/**
 * Unit test for RedisCachingClient
 * In this scenario we will test using only mocks avoind connections
 */
class RedisCachingClientTest extends AbstractUnitTestCase
{
    protected RedisCachingClient $instance;

    public function setUp(): void
    {
        parent::setUp();
    }

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
        if ($cacheClient == null) {
            /**
             * patch the class attribute client with a mock
             */
            $this->patch($instance, 'client', (new ClientMock())->getObjectWithMockDependencies());
        }

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
        if ($cacheClient == null) {
            /**
             * patch the class attribute client with a mock
             */
            $this->patch($instance, 'client', (new ClientMock())->getObjectWithMockDependencies());
            if (!$expectedResult) {
                /**
                 * Específic mock for error scenário
                 */
                $mock = (new ClientMock())->getMock();
                $mock->connect()->willThrow(ConnectionException::class);
                $this->patch($instance, 'client', $mock->reveal());
            }
        }

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
        $predis = (new ClientMock())->getObjectWithMockDependencies();
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
