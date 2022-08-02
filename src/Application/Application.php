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
use Illuminate\Events\EventServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Concerns\RegistersExceptionHandlers;
use Laravel\Lumen\Concerns\RoutesRequests;
use Laravel\Lumen\Routing\Router;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * Pattern Family: Creational
 * Pattern Name: Dependency Injection
 * Group: Dependency Injection
 */
class Application extends \Laravel\Lumen\Application
{
    use RoutesRequests,
        RegistersExceptionHandlers;
    /**
     * Indicates if the class aliases have been registered.
     *
     * @var bool
     */
    protected static $aliasesRegistered = false;

    /**
     * The base path of the application installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * All the loaded configuration files.
     *
     * @var array
     */
    protected $loadedConfigurations = [];

    /**
     * Indicates if the application has "booted".
     *
     * @var bool
     */
    protected $booted = false;

    /**
     * The loaded service providers.
     *
     * @var array
     */
    protected $loadedProviders = [];

    /**
     * The Router instance.
     *
     * @var \Laravel\Lumen\Routing\Router
     */
    public $router;
    /**
     * The custom storage path defined by the developer.
     *
     * @var string
     */
    protected $storagePath;

    /**
     * Create a new Application instance.
     *
     * @param string|null $basePath
     * @return void
     * @throws BindingResolutionException
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

//    /**
//     * Bootstrap the router instance.
//     *
//     * @return void
//     */
//    public function bootstrapRouter()
//    {
//        $this->router = new Router($this);
//    }
//
//    /**
//     * Boots the registered providers.
//     */
//    public function boot()
//    {
//        if ($this->booted) {
//            return;
//        }
//
//        foreach ($this->loadedProviders as $provider) {
//            $this->bootProvider($provider);
//        }
//
//        $this->booted = true;
//    }
//
//    /**
//     * Get the path to the application "app" directory.
//     *
//     * @return string
//     */
//    public function path(): string
//    {
//        return $this->basePath . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Application';
//    }
//
//    /**
//     * Get the base path for the application.
//     *
//     * @param string $path
//     * @return string
//     */
//    public function basePath($path = ''): string
//    {
//        if (isset($this->basePath)) {
//            return $this->basePath . ($path ? '/' . $path : $path);
//        }
//
//        if ($this->runningInConsole()) {
//            $this->basePath = getcwd();
//        } else {
//            $this->basePath = realpath(getcwd() . '/../');
//        }
//
//        return $this->basePath($path);
//    }
//
//    /**
//     * Get the path to the database directory.
//     *
//     * @param string $path
//     * @return string
//     */
//    public function databasePath($path = ''): string
//    {
//        return $this->basePath.DIRECTORY_SEPARATOR.'database'.($path ? DIRECTORY_SEPARATOR.$path : $path);
//    }
//
//    /**
//     * Get or check the current application environment.
//     *
//     * @param mixed
//     * @return string
//     */
//    public function environment(...$environments): string
//    {
//        return env('APP_ENV', 'development');
//    }
//
//
//    /**
//     * Determine if the given service provider is loaded.
//     *
//     * @param string $provider
//     * @return bool
//     */
//    public function providerIsLoaded(string $provider): bool
//    {
//        return isset($this->loadedProviders[$provider]);
//    }
//
//    /**
//     * Boot the given service provider.
//     *
//     * @param ServiceProvider $provider
//     * @return mixed
//     */
//    protected function bootProvider(ServiceProvider $provider)
//    {
//        if (method_exists($provider, 'boot')) {
//            return $this->call([$provider, 'boot']);
//        }
//    }
//
//    /**
//     * Register a service provider with the application.
//     *
//     * @param ServiceProvider|string $provider
//     * @return void
//     */
//    public function register($provider, $force = false)
//    {
//        if (!$provider instanceof ServiceProvider) {
//            $provider = new $provider($this);
//        }
//
//        if (array_key_exists($providerName = get_class($provider), $this->loadedProviders)) {
//            return;
//        }
//
//        $this->loadedProviders[$providerName] = $provider;
//
//        if (method_exists($provider, 'register')) {
//            $provider->register();
//        }
//
//        if ($this->booted) {
//            $this->bootProvider($provider);
//        }
//    }
//
//    /**
//     * Determine if the application is running in the console.
//     *
//     * @return bool
//     */
//    public function runningInConsole(): bool
//    {
//        return \PHP_SAPI === 'cli' || \PHP_SAPI === 'phpdbg';
//    }
//
//    /**
//     * Determine if we are running unit tests.
//     *
//     * @return bool
//     */
//    public function runningUnitTests(): bool
//    {
//        return $this->environment() == 'testing';
//    }
//
//    /**
//     * Register container bindings for the application.
//     *
//     * @return void
//     */
//    protected function registerConfigBindings()
//    {
//        $this->singleton('config', function () {
//            return new ConfigRepository;
//        });
//    }
//
//    /**
//     * Register container bindings for the application.
//     *
//     * @return void
//     */
//    protected function registerDatabaseBindings()
//    {
//        $this->singleton('db', function () {
//            $this->configure('app');
//
//            return $this->loadComponent(
//                'database', [
//                DatabaseServiceProvider::class,
//                PaginationServiceProvider::class,
//            ], 'db'
//            );
//
//        });
//
//    }
//
//    /**
//     * Configure and load the given component and provider.
//     *
//     * @param string $config
//     * @param array|string $providers
//     * @param string|null $return
//     * @return mixed
//     * @throws BindingResolutionException
//     */
//    public function loadComponent(string $config, $providers, string $return = null)
//    {
//        $this->configure($config);
//
//        foreach ((array)$providers as $provider) {
//            $this->register($provider);
//        }
//
//        return $this->make($return ?: $config);
//    }
//
//    /**
//     * Load a configuration file into the application.
//     *
//     * @param string $name
//     * @return void
//     * @throws BindingResolutionException
//     */
//    public function configure(string $name)
//    {
//        if (isset($this->loadedConfigurations[$name])) {
//            return;
//        }
//
//        $this->loadedConfigurations[$name] = true;
//
//
//        $configurationClass = ConfigurationTypeEnum::getConfiguration($name);
//
//        if ($configurationClass) {
//            /** @var AbstractConfiguration $configInstance */
//            $configInstance = new $configurationClass();
//            $this->make('config')->set($name, $configInstance->getConfiguration());
//        }
//
//    }
//
//    /**
//     * Register the core container aliases.
//     *
//     * @return void
//     */
//    protected function registerContainerAliases()
//    {
//        $this->aliases = [
//            'log' => Logger::class,
//            'request' => \Illuminate\Http\Request::class,
//            \Illuminate\Contracts\Foundation\Application::class => 'app',
//            \Illuminate\Container\Container::class => 'app',
//            \Illuminate\Contracts\Container\Container::class => 'app',
//            \Illuminate\Database\ConnectionResolverInterface::class => 'db',
//            \Illuminate\Database\DatabaseManager::class => 'db',
//        ];
//    }
//
//    /**
//     * Prepare the given request instance for use with the application.
//     *
//     * @param  \Symfony\Component\HttpFoundation\Request $request
//     * @return \Illuminate\Http\Request
//     */
//    protected function prepareRequest(SymfonyRequest $request)
//    {
//        if (! $request instanceof Request) {
//            $request = Request::createFromBase($request);
//        }
//
//        $request->setUserResolver(function ($guard = null) {
//            return $this->make('auth')->guard($guard)->user();
//        })->setRouteResolver(function () {
//            return $this->currentRoute;
//        });
//
//        return $request;
//    }
//
//    /**
//     * Register container bindings for the application.
//     *
//     * @return void
//     */
//    protected function registerEventBindings()
//    {
//        $this->singleton('events', function () {
//            $this->register(EventServiceProvider::class);
//
//            return $this->make('events');
//        });
//    }
//
//    /**
//     * Get the storage path for the application.
//     *
//     * @param  string|null  $path
//     * @return string
//     */
//    public function storagePath($path = '')
//    {
//        return ($this->storagePath ?: $this->basePath.DIRECTORY_SEPARATOR.'storage').($path ? DIRECTORY_SEPARATOR.$path : $path);
//    }
//
//    /**
//     * Set the storage directory.
//     *
//     * @param  string  $path
//     * @return $this
//     */
//    public function useStoragePath($path)
//    {
//        $this->storagePath = $path;
//
//        $this->instance('path.storage', $path);
//
//        return $this;
//    }
//
//    /**
//     * Register the facades for the application.
//     *
//     * @param  bool  $aliases
//     * @param  array  $userAliases
//     * @return void
//     */
//    public function withFacades($aliases = true, $userAliases = [])
//    {
//        Facade::setFacadeApplication($this);
//
//        if ($aliases) {
//            $this->withAliases($userAliases);
//        }
//    }
//
//    /**
//     * Register the aliases for the application.
//     *
//     * @param  array  $userAliases
//     * @return void
//     */
//    public function withAliases($userAliases = [])
//    {
//        $defaults = [
//            \Illuminate\Support\Facades\Auth::class => 'Auth',
//            \Illuminate\Support\Facades\Cache::class => 'Cache',
//            \Illuminate\Support\Facades\DB::class => 'DB',
//            \Illuminate\Support\Facades\Event::class => 'Event',
//            \Illuminate\Support\Facades\Gate::class => 'Gate',
//            \Illuminate\Support\Facades\Log::class => 'Log',
//            \Illuminate\Support\Facades\Queue::class => 'Queue',
//            \Illuminate\Support\Facades\Route::class => 'Route',
//            \Illuminate\Support\Facades\Schema::class => 'Schema',
//            \Illuminate\Support\Facades\Storage::class => 'Storage',
//            \Illuminate\Support\Facades\URL::class => 'URL',
//            \Illuminate\Support\Facades\Validator::class => 'Validator',
//        ];
//
//        if (! static::$aliasesRegistered) {
//            static::$aliasesRegistered = true;
//
//            $merged = array_merge($defaults, $userAliases);
//
//            foreach ($merged as $original => $alias) {
//                class_alias($original, $alias);
//            }
//        }
//    }

}
