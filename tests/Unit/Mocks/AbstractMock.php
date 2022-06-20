<?php

declare(strict_types=1);

namespace Application\Tests\Unit\Mocks;

use DateTime;
use Monolog\Logger;
use Prophecy\Argument;
use Prophecy\Argument\Token\TypeToken;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Http\Message\ResponseInterface as ServerResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AbstractMock
 */
abstract class AbstractMock
{
    /**
     * @var Prophet
     */
    protected Prophet $prophet;

    /**
     * @var Logger|null
     */
    protected ?Logger $logger;
    /**
     * @var TypeToken|array
     */
    protected TypeToken $typeArray;

    /**
     * @var TypeToken|bool
     */
    protected TypeToken $typeBoolean;

    /**
     * @var TypeToken|float
     */
    protected TypeToken $typeFloat;

    /**
     * @var TypeToken|int
     */
    protected TypeToken $typeInteger;

    /**
     * @var TypeToken|string
     */
    protected TypeToken $typeString;

    /**
     * @var TypeToken|DateTime
     */
    protected TypeToken $typeDateTime;

    /**
     * @var TypeToken|ServerRequestInterface
     */
    protected TypeToken $typeServerRequest;

    /**
     * @var TypeToken|ServerResponseInterface
     */
    protected TypeToken $typeServerResponse;

    /**
     * AbstractMock constructor.
     *
     * @param Logger|null $logger
     */
    public function __construct(Logger $logger = null)
    {
        $this->prophet      = new Prophet();
        $this->logger = $logger;

        $this->typeArray    = Argument::type('array');
        $this->typeBoolean  = Argument::type('bool');
        $this->typeFloat    = Argument::type('float');
        $this->typeInteger  = Argument::type('int');
        $this->typeString   = Argument::type('string');
        $this->typeDateTime = Argument::type(DateTime::class);

    }

    /**
     * @param string $class
     *
     * @return ProphecyInterface
     */
    protected function prophesize(string $class): ProphecyInterface
    {
        return $this->prophet->prophesize($class);
    }

    /**
     * @return ProphecyInterface
     */
    abstract public function getMock(): ProphecyInterface;

    /**
     * @return object
     */
    abstract public function getObjectWithMockDependencies(): object;
}
