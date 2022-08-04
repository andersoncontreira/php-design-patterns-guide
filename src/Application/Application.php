<?php

declare(strict_types=1);

namespace Application;

use Application\Configuration\AbstractConfiguration;
use Application\Enums\ConfigurationTypeEnum;
use Application\Logger\ConsoleLogger;
use Illuminate\Contracts\Container\BindingResolutionException;
use Monolog\Logger;

/**
 * Pattern Family: Creational
 * Pattern Name: Dependency Injection
 * Group: Dependency Injection
 */
class Application extends \Laravel\Lumen\Application
{
    /**
     * Create a new Application instance.
     *
     * @param string|null $basePath
     * @return void
     */
    public function __construct(string $basePath = null)
    {
        parent::__construct($basePath);
        $this->basePath = $basePath;

        $this->registerConfigBindings();
        $this->registerDatabaseBindings();
        $this->registerEventBindings();

    }

    /**
     * Bootstrap the application container.
     *
     * @return void
     */
    protected function bootstrapContainer()
    {
        parent::bootstrapContainer();
        static::setInstance($this);

        $consoleLogger = new ConsoleLogger();
        $this->instance(Logger::class, $consoleLogger);

    }

    /**
     * Load a configuration file into the application.
     *
     * @param string $name
     * @return void
     * @throws BindingResolutionException
     */
    public function configure($name)
    {
        parent::configure($name);

        $configurationClass = ConfigurationTypeEnum::getConfiguration($name);

        if ($configurationClass) {
            /** @var AbstractConfiguration $configInstance */
            $configInstance = new $configurationClass();
            $this->make('config')->set($name, $configInstance->getConfiguration());
        }

    }

}
