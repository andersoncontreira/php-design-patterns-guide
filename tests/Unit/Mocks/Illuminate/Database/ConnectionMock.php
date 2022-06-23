<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Mocks\Illuminate\Database;


use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Processors\MySqlProcessor;
use Illuminate\Support\LazyCollection;
use Monolog\Logger;
use Prophecy\Argument;
use Prophecy\Prophecy\ProphecyInterface;

class ConnectionMock extends \Application\Tests\Unit\Mocks\AbstractMock
{
    public static array $sampleData = [];

    public function __construct(Logger $logger = null)
    {
        parent::__construct($logger);

    }

    /**
     * @inheritDoc
     */
    public function getMock(): ProphecyInterface
    {
        $sampleData = self::$sampleData;

        /** @var LazyCollection $cursor */
        $cursor = $this->prophesize(LazyCollection::class);
        $cursor->all()->will(function () use ($sampleData) {
            return $sampleData;
        });

        /** @var Connection $connectionMock */
        $connectionMock = $this->prophesize(Connection::class);
        $connectionMock->setReadWriteType(Argument::any())->willReturn($connectionMock);
        $connectionMock->cursor()->willReturn($cursor);


        //$queryBuilder = new QueryBuilder($connectionMock->reveal(), new MySqlGrammar(), new MySqlProcessor());
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->prophesize(QueryBuilder::class);
        $queryBuilder->select($this->typeArray)->willReturn($queryBuilder);
        $queryBuilder->from($this->typeString, $this->typeString)->willReturn($queryBuilder);
        $queryBuilder->offset($this->typeInteger)->willReturn($queryBuilder);
        $queryBuilder->cursor()->willReturn($cursor->reveal());
        $queryBuilder = $queryBuilder->reveal();

        // query
        $connectionMock->query()->willReturn($queryBuilder);
        $connectionMock->select($this->typeString, $this->typeArray, $this->typeBoolean)->willReturn($queryBuilder);
        // table
        $connectionMock->table($this->typeString, $this->typeString)->will(function ($args) use ($queryBuilder) {
            $table = $args[0];
            $as = $args[1];

            //return $this->query()->from($table, $as);
            return $queryBuilder->from($table, $as);
        });

//        $connectionMock->setReadWriteType(Argument::any())->will(function ($args) {
//            return [];
//        });

        return $connectionMock;
    }

    /**
     * @inheritDoc
     */
    public function getObjectWithMockDependencies(): object
    {
        /**
         * In this case we can't instanciate the class object, because it tries to connect to db
         */
        return $this->getMock()->reveal();

    }
}
