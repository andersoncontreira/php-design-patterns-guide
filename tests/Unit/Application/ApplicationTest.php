<?php

namespace Application\Tests\Unit\Application;

use Application\Application;
use Application\Tests\Unit\AbstractUnitTestCase;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 *
 */
class ApplicationTest extends AbstractUnitTestCase
{
    protected Application $instance;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testInstanceContainer()
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );
        $app = null;
        try {
            $this->instance = new Application(APP_ROOT);
            $logger = $this->instance->get(Logger::class);
            $app = $this->instance->get('app');
        } catch (\Exception $e) {
            $this->logger->error($e);
        }


        self::assertInstanceOf(Application::class, $app);
        self::assertTrue($app == $this->instance);

    }

//    public function testBoot()
//    {
//        $this->logger->info(
//            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
//        );
//
//        $this->instance->boot();
//    }
//
//    public function testRegister()
//    {
//        $this->logger->info(
//            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
//        );
//
//        $this->instance->register(ConfigurationProvider::class);
//    }
}
