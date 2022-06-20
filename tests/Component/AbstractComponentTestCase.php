<?php

declare(strict_types=1);

namespace Application\Tests\Component;

use Application\Application;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Tests\Unit\Helpers\ConsoleLoggerHelper;

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

        $app = new Application(APP_ROOT);

        /** @var ContainerInterface $container */
        $this->container = $app->getContainer();

        try {
            $this->logger = $this->container->get(Logger::class);
        } catch (\Throwable $e) {
            $this->logger = ConsoleLoggerHelper::getLogger();
        }

    }

}
