<?php

declare(strict_types=1);

namespace Application\Tests\Component;

use Application\Application;
use Application\Tests\Unit\Helpers\ConsoleLoggerHelper;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * Class AbstractComponentTestCase
 */
abstract class AbstractComponentTestCase extends TestCase
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ContainerInterface $container */
        $this->container = new Application(APP_ROOT);

        try {
            $this->logger = $this->container->get(Logger::class);
        } catch (\Throwable $e) {
            $this->logger = ConsoleLoggerHelper::getLogger();
        }

    }

}
