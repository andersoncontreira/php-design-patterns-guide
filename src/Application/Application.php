<?php

declare(strict_types=1);

namespace Application;

use Application\Logger\ConsoleLogger;
use Application\Providers\ServiceProvider;
use League\Container\Container;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Application
{
    /**
     * @var Container application Container
     */
    protected Container $container;

    /**
     * The base path of the application installation.
     *
     * @var string
     */
    protected string $basePath;

    /**
     * Indicates if the application has "booted".
     *
     * @var bool
     */
    protected bool $booted = false;

    /**
     * The loaded service providers.
     *
     * @var array
     */
    protected $loadedProviders = [];

    /**
     * Create a new Application instance.
     *
     * @param string|null $basePath
     * @return void
     */
    public function __construct(string $basePath = null)
    {
        $this->basePath = $basePath;

        $this->bootstrapContainer();
//        $this->registerErrorHandling();
//        $this->bootstrapRouter();
    }


    protected function bootstrapContainer()
    {
        /**
         * Applicaiton container
         */
        $this->container = new Container();

        /**
         * Self instances of the application
         */
        $this->instance('app', $this);
        $this->instance(self::class, $this);


        $this->instance('path', $this->path());
        $this->instance('env', $this->environment());

        $consoleLogger = new ConsoleLogger();
        $this->instance('log', $consoleLogger);
        $this->instance(Logger::class, $consoleLogger);

    }

    /**
     * Boots the registered providers.
     */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        foreach ($this->loadedProviders as $provider) {
            $this->bootProvider($provider);
        }

        $this->booted = true;
    }

    /**
     * Get the path to the application "app" directory.
     *
     * @return string
     */
    public function path(): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Application';
    }

    /**
     * Get or check the current application environment.
     *
     * @param  mixed
     * @return string
     */
    public function environment(): string
    {
        return getenv('APP_ENV') ?: 'development';
    }

    /**
     * Set instance or alias to container
     * @param string $id
     * @param $concrete
     * @return void
     */
    private function instance(string $id, $concrete = null): void
    {
        $this->container->add($id, $concrete);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function get(string $id)
    {
        return $this->container->get($id);
    }

    /**
     * Determine if the given service provider is loaded.
     *
     * @param  string  $provider
     * @return bool
     */
    public function providerIsLoaded(string $provider): bool
    {
        return isset($this->loadedProviders[$provider]);
    }

    /**
     * Boot the given service provider.
     *
     * @param  ServiceProvider  $provider
     * @return mixed
     */
    protected function bootProvider(ServiceProvider $provider)
    {
        if (method_exists($provider, 'boot')) {
            return $this->call([$provider, 'boot']);
        }
    }

    /**
     * Register a service provider with the application.
     *
     * @param  ServiceProvider|string  $provider
     * @return void
     */
    public function register($provider)
    {
        if (! $provider instanceof ServiceProvider) {
            $provider = new $provider($this);
        }

        if (array_key_exists($providerName = get_class($provider), $this->loadedProviders)) {
            return;
        }

        $this->loadedProviders[$providerName] = $provider;

        if (method_exists($provider, 'register')) {
            $provider->register();
        }

        if ($this->booted) {
            $this->bootProvider($provider);
        }
    }

    /**
     * @param $callback
     * @param array $parameters
     * @param $defaultMethod
     * @return mixed
     */
    private function call($callback, array $parameters = [], $defaultMethod = null)
    {
//        return BoundMethod::call($this, $callback, $parameters, $defaultMethod);
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
