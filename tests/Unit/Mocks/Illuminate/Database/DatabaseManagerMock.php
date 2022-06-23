<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Mocks\Illuminate\Database;


use Application\Application;
use Application\Tests\Unit\Mocks\AbstractMock;
use Application\Tests\Unit\Mocks\Application\ApplicationMock;
use Application\Tests\Unit\Mocks\Illuminate\Database\Connectors\ConnectionFactoryMock;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\DatabaseManager;
use Monolog\Logger;
use Prophecy\Prophecy\ProphecyInterface;

class DatabaseManagerMock extends AbstractMock
{
    public Application $application;
    public ConnectionFactory $factory;

    public function __construct(Logger $logger = null, Application $application = null, ConnectionFactory $factory = null)
    {
        parent::__construct($logger);
        if ($application == null) {
            $application = (new ApplicationMock())->getMock()->reveal();
        }
        if ($factory == null) {
            $factory = (new ConnectionFactoryMock())->getObjectWithMockDependencies();
        }
        $this->factory = $factory;
        $this->application = $application;
    }

    public function getMock(): ProphecyInterface
    {
        /** @var DatabaseManager $mock */
        $mock = $this->prophesize(DatabaseManager::class);

        return $mock;
    }

    /**
     * @return DatabaseManager
     */
    public function getObjectWithMockDependencies(): object
    {
        return new DatabaseManager($this->application, $this->factory);
    }
}
