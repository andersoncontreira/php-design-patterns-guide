<?php

declare(strict_types=1);

namespace Application\Tests\Component;

use Application\Application;
use Application\Tests\Unit\Helpers\ConsoleLoggerHelper;
use Laravel\Lumen\Testing\TestCase;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

/**
 * Class AbstractComponentTestCase
 */
abstract class AbstractComponentTestCase extends TestCase
{

    /**
     * @var Logger
     */
    protected static Logger $staticLogger;
    /**
     * @var Logger
     */
    protected $logger;

    /**
     *
     * @var ContainerInterface
     */
    protected $container;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$staticLogger = ConsoleLoggerHelper::getLogger();

    }

    /**
     * @return void
     */
    public function setUp(): void
    {
        /**
         * If something strange happens here, it can be caused by misconfiguration of the project
         * like the connection
         */
        parent::setUp();

        /** @var ContainerInterface $container */
        $this->container = $this->app;

        try {
            $this->logger = $this->container->get(Logger::class);
        } catch (\Throwable $e) {
            $this->logger = ConsoleLoggerHelper::getLogger();
        }

    }

    /**
     * @return Application
     */
    public function createApplication()
    {
        return new Application(APP_ROOT);
    }

}
