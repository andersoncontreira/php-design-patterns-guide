<?php

declare(strict_types=1);

namespace Application\Tests\Component;

use Application\Application;
use Application\Logger\ConsoleLogger;
use Application\Tests\Unit\Helpers\ConsoleLoggerHelper;
use Laravel\Lumen\Testing\TestCase;
use Monolog\Logger;
//use PHPUnit\Framework\TestCase;
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

        try {
            $this->logger = $this->app->get(Logger::class);
        } catch (\Throwable $e) {
            $this->logger = ConsoleLoggerHelper::getLogger();
        }

    }

    public function createApplication(): Application
    {
        return new Application(APP_ROOT);
    }

}
