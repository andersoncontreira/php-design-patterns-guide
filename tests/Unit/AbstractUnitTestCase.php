<?php

declare(strict_types=1);

namespace Application\Tests\Unit;

use Application\Caching\RedisCachingClient;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Prophecy\Doubler\DoubleInterface;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use Application\Tests\Unit\Helpers\ConsoleLoggerHelper;

/**
 * Class AbstractUnitTestCase
 */
abstract class AbstractUnitTestCase extends TestCase
{
    use ProphecyTrait;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Neste caso o container deve ser instanciado via Mock.
     *
     * @var DoubleInterface|ContainerInterface
     */
    protected $container;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);
        /** Mocking  Logger */
        try {
            $container->get(Logger::class)->willReturn(ConsoleLoggerHelper::getLogger());
            $this->container = $container->reveal();

            $this->logger = $this->container->get(Logger::class);
        } catch (\Throwable $e) {
            $this->logger = ConsoleLoggerHelper::getLogger();
        }

    }

    /**
     * Patch a object attribute
     * @param object $instance
     * @param string $property
     * @param $value
     * @return void
     */
    protected function patch(object $instance, string $property, $value)
    {
        $reflection = new \ReflectionClass($instance);
        try {
            $property = $reflection->getProperty($property);
            $property->setAccessible(true);
            $property->setValue($instance, $value);
        } catch (\ReflectionException $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
