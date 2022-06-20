<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Mocks\Predis;


use Application\Tests\Unit\Mocks\AbstractMock;
use Predis\Client;
use Predis\Connection\StreamConnection;
use Prophecy\Prophecy\ProphecyInterface;

/**
 * Mock for Predis/Client
 */
class ClientMock extends AbstractMock
{

    /**
     * @inheritDoc
     */
    public function getMock(): ProphecyInterface
    {
        /** @var ProphecyInterface|Client $entity */
        $client = $this->prophesize(Client::class);


        $connenction = $this->prophesize(StreamConnection::class);
        $connenction->isConnected()->willReturn(true);

        $client->getConnection()->willReturn($connenction->reveal());
        $client->isConnected()->willReturn(true);

        return $client;
    }

    /**
     * @inheritDoc
     */
    public function getObjectWithMockDependencies(): object
    {
        /**
         * In this case we don't have any other class to inject here, so we will return the mock itself as
         * object
         */
        return $this->getMock()->reveal();
    }
}
