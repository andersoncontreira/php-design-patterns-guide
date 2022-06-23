<?php

declare(strict_types=1);

namespace Application;

use Application\Configuration\AbstractConfiguration;
use Application\Enums\ConfigurationTypeEnum;
use Application\Logger\ConsoleLogger;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger;

/**
 * Pattern Family: Creational
 * Pattern Name: Dependency Injection
 * Group: Dependency Injection
 */
class Application extends Container
{
//    use Concerns\RoutesRequests,
//        Concerns\RegistersExceptionHandlers;
    /**
     * The base path of the application installation.
     *
     * @var string
     */
    protected string $basePath;

    /**
     * All of the loaded configuration files.
     *
     * @var array
     */
    protected array $loadedConfigurations = [];

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
     * @throws BindingResolutionException
     */
    public function __construct(string $basePath = null)
    {
        $this->basePath = $basePath;

        $this->bootstrapContainer();
//        $this->registerErrorHandling();
//        $this->bootstrapRouter();

        $this->registerConfigBindings();
        $this->registerDatabaseBindings();

    }


    protected function bootstrapContainer()
    {
        static::setInstance($this);

        /**
         * Self instances of the application
         */
        $this->instance('app', $this);
        $this->instance(self::class, $this);


        $this->instance('path', $this->path());
        $this->instance('env', $this->environment());

        $consoleLogger = new ConsoleLogger();
        $this->instance(Logger::class, $consoleLogger);

        $this->registerContainerAliases();

    }

    /**
     * Bootstrap the router instance.
     *
     * @return void
     */
    public function bootstrapRouter()
    {
//        $this->router = new Router($this);
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
        return $this->basePath . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Application';
    }

    /**
     * Get the base path for the application.
     *
     * @param string $path
     * @return string
     */
    public function basePath(string $path = ''): string
    {
        if (isset($this->basePath)) {
            return $this->basePath . ($path ? '/' . $path : $path);
        }

        if ($this->runningInConsole()) {
            $this->basePath = getcwd();
        } else {
            $this->basePath = realpath(getcwd() . '/../');
        }

        return $this->basePath($path);
    }

    /**
     * Get the path to the database directory.
     *
     * @param string $path
     * @return string
     */
    public function databasePath(string $path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'database'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get or check the current application environment.
     *
     * @param mixed
     * @return string
     */
    public function environment(): string
    {
        return env('APP_ENV', 'development');
    }


    /**
     * Determine if the given service provider is loaded.
     *
     * @param string $provider
     * @return bool
     */
    public function providerIsLoaded(string $provider): bool
    {
        return isset($this->loadedProviders[$provider]);
    }

    /**
     * Boot the given service provider.
     *
     * @param ServiceProvider $provider
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
     * @param ServiceProvider|string $provider
     * @return void
     */
    public function register($provider)
    {
        if (!$provider instanceof ServiceProvider) {
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
     * Determine if the application is running in the console.
     *
     * @return bool
     */
    public function runningInConsole(): bool
    {
        return \PHP_SAPI === 'cli' || \PHP_SAPI === 'phpdbg';
    }

    /**
     * Determine if we are running unit tests.
     *
     * @return bool
     */
    public function runningUnitTests(): bool
    {
        return $this->environment() == 'testing';
    }

    /**
     * Register container bindings for the application.
     *
     * @return void
     */
    protected function registerConfigBindings()
    {
        $this->singleton('config', function () {
            return new ConfigRepository;
        });
    }

    /**
     * Register container bindings for the application.
     *
     * @return void
     */
    protected function registerDatabaseBindings()
    {
        $this->singleton('db', function () {
            $this->configure('app');

            return $this->loadComponent(
                'database', [
                DatabaseServiceProvider::class,
                PaginationServiceProvider::class,
            ], 'db'
            );

        });

    }

    /**
     * Configure and load the given component and provider.
     *
     * @param string $config
     * @param array|string $providers
     * @param string|null $return
     * @return mixed
     * @throws BindingResolutionException
     */
    public function loadComponent(string $config, $providers, string $return = null)
    {
        $this->configure($config);

        foreach ((array)$providers as $provider) {
            $this->register($provider);
        }

        return $this->make($return ?: $config);
    }

    /**
     * Load a configuration file into the application.
     *
     * @param string $name
     * @return void
     * @throws BindingResolutionException
     */
    public function configure(string $name)
    {
        if (isset($this->loadedConfigurations[$name])) {
            return;
        }

        $this->loadedConfigurations[$name] = true;


        $configurationClass = ConfigurationTypeEnum::getConfiguration($name);

        if ($configurationClass) {
            /** @var AbstractConfiguration $configInstance */
            $configInstance = new $configurationClass();
            $this->make('config')->set($name, $configInstance->getConfiguration());
        }

    }

    /**
     * Register the core container aliases.
     *
     * @return void
     */
    protected function registerContainerAliases()
    {
        $this->aliases = [
            'log' => Logger::class,
            \Illuminate\Contracts\Foundation\Application::class => 'app',
            \Illuminate\Container\Container::class => 'app',
            \Illuminate\Contracts\Container\Container::class => 'app',
            \Illuminate\Database\ConnectionResolverInterface::class => 'db',
            \Illuminate\Database\DatabaseManager::class => 'db',
        ];
    }

}
