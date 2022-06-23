<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Mocks\Illuminate\Database\Connectors;


use Application\Tests\Unit\Mocks\AbstractMock;
use Application\Tests\Unit\Mocks\Illuminate\Database\ConnectionMock;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Monolog\Logger;
use Prophecy\Prophecy\ProphecyInterface;

class ConnectionFactoryMock extends \Application\Tests\Unit\Mocks\AbstractMock
{

    public Connection $connection;

    public function __construct(Logger $logger = null, Connection $connection = null)
    {
        parent::__construct($logger);
        if ($connection == null) {
            $connection = (new ConnectionMock())->getObjectWithMockDependencies();
        }

        $this->connection = $connection;

    }

    /**
     * @inheritDoc
     */
    public function getMock(): ProphecyInterface
    {



        /** @var ConnectionFactory $factory */
        $factory = $this->prophesize(ConnectionFactory::class);
        $factory->make($this->typeArray, $this->typeString)->willReturn($this->connection);

        return $factory;
    }

    /**
     * @inheritDoc
     */
    public function getObjectWithMockDependencies(): object
    {
        return $this->getMock()->reveal();
    }
}
