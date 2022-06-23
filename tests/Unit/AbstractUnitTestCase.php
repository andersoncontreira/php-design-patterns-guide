<?php

declare(strict_types=1);

namespace Application\Tests\Unit;

use Application\Tests\Unit\Mocks\Application\ApplicationMock;
use Illuminate\Container\Container;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Prophecy\Doubler\DoubleInterface;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

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
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->container = (new ApplicationMock())->getObjectWithMockDependencies();

        $this->logger = $this->container->get(Logger::class);

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
