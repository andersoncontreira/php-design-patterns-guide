<?php

namespace Application\Tests\Component\Application;

use Application\Application;
use Application\Tests\Component\AbstractComponentTestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 *
 */
class ApplicationTestCase extends AbstractComponentTestCase
{
    protected Application $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = new Application(APP_ROOT);

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

        $app = $this->instance->get(Application::class);

        self::assertInstanceOf(Application::class, $app);
        self::assertTrue($app == $this->instance);

    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testGet()
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, null)
        );

        $config = $this->instance->get('config');
        $log = $this->instance->get('log');
        $db = $this->instance->get('db');

        self::assertNotNull($config);
        self::assertNotNull($log);
        self::assertNotNull($db);
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
