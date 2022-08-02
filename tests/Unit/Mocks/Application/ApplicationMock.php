<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Mocks\Application;


use Application\Application;
use Application\Configuration\ApplicationConfiguration;
use Application\Enums\ConfigurationTypeEnum;
use Application\Configuration\DatabaseConfiguration;
use Application\Logger\ConsoleLogger;
use Application\Tests\Unit\Helpers\ConsoleLoggerHelper;
use Application\Tests\Unit\Mocks\AbstractMock;
use Application\Tests\Unit\Mocks\Illuminate\Database\DatabaseManagerMock;
use Illuminate\Container\Container;
use Illuminate\Database\DatabaseManager;
use Monolog\Logger;
use Prophecy\Argument;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Config\Repository as ConfigRepository;

class ApplicationMock extends AbstractMock
{
    public static function populateMock(ProphecyInterface $application): ProphecyInterface
    {
        //adicional
        return $application;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getMock(): ProphecyInterface
    {

        $logger = ConsoleLoggerHelper::getLogger();

        $reflection = new \ReflectionClass(Application::class);
        /** @var Application $appFake */
        $appFake = $reflection->newInstanceWithoutConstructor();
        $appFake->basePath(APP_ROOT);

        $applicationMock = $this->prophesize(Application::class);

        $applicationMock->databasePath($this->typeString)->will(function ($args) use ($appFake) {
            //$this->getName()->willReturn($args[0]);
            return $appFake->databasePath($args[0]);
        });

        $applicationMock->make($this->typeString, $this->typeArray)->will(function ($args) use ($appFake) {
            return $appFake->make($args[0], $args[1]);
        });

        /** @var Application $temporary */
        $temporary = $applicationMock->reveal();

        // Inital instance to avoid errors like:
        // databasePath
        Container::setInstance($temporary);

        // config
        $configuration = new ConfigRepository();
        $configuration->set(ConfigurationTypeEnum::app, ApplicationConfiguration::getConfigurationArray());
        $configuration->set(ConfigurationTypeEnum::database, DatabaseConfiguration::getConfigurationArray());

        $applicationMock->get('app')->willReturn($applicationMock);
        $applicationMock->get(Application::class)->willReturn($applicationMock);

        $applicationMock->get('config')->willReturn($configuration);
        $applicationMock->get('path')->willReturn($appFake->path());
        $applicationMock->get('env')->willReturn($appFake->environment());

        // minimun required params
        $applicationMock->get(Logger::class)->willReturn($logger);
        $applicationMock->get('log')->willReturn($logger);


        //$applicationMock->get('config')->willReturn($configuration);

        $properties = [
            'config' => $configuration
        ];
        $applicationMock->offsetGet(Argument::any())->will(function($args) use ($properties){
            $key = $args[0];
            return $properties[$key];
        });
        $applicationMock->offsetSet(Argument::cetera())->will(function($args) use ($properties){
//            if(is_null($args[0])){
//                $user_data[] = $args[1];
//            } else {
//                $user_data[$args[0]] = $args[1];
//            }
            $key = $args[0];
            return $properties[$key];
        });
        $applicationMock->offsetExists(Argument::any())->will(function($args) use ($properties){
//            return ;
//            $key = $args[0];
//            return $x[$key];
            return in_array($args[0], array_keys($properties));
        });

        return $applicationMock;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getObjectWithMockDependencies(): object
    {
        /**
         * Current object mock
         */
        $container = $this->getMock();

        $manager = (new DatabaseManagerMock())->getObjectWithMockDependencies();

        $container->get(DatabaseManager::class)->willReturn($manager);
        $container->get('db')->willReturn($manager);

        /** @var Application $app */
        $app = $container->reveal();
        // Register the container
        Container::setInstance($app);

        return $app;
    }




}
