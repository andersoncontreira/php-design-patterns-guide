<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $make
     * @param array $parameters
     * @throws BindingResolutionException
     */
    function app(string $make = null, array $parameters = [])
    {
        if (is_null($make)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($make, $parameters);
    }
}

if (! function_exists('database_path')) {
    /**
     * Get the path to the database directory of the install.
     *
     * @param string $path
     * @return string
     * @throws BindingResolutionException
     */
    function database_path(string $path = ''): string
    {
        return app()->databasePath($path);
    }
}

if (! function_exists('to_array')) {
    function to_array($item)
    {
        if (!is_array($item)) {
            $item = json_decode(json_encode($item), true);
        }
        return $item;
    }
}

if (! function_exists('get_environment')) {
    function get_environment()
    {
        return env('APP_ENV', 'development');
    }
}
