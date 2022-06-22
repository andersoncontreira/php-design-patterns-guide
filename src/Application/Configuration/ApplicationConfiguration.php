<?php

declare(strict_types=1);


namespace Application\Configuration;


class ApplicationConfiguration extends AbstractConfiguration
{
    public function __construct()
    {
        $this->configuration = [
            'APP_ENV' => env('APP_ENV', 'development'),
            'APP_PORT'=> env('APP_PORT', 5000),
            'APP_NAME' => env('APP_NAME', 'php-design-patterns-guide'),
            'APP_VERSION' => env('APP_VERSION', '1.0.0'),
            'APP_ARCH_VERSION' => env('APP_ARCH_VERSION', 'v1')
        ];
    }

}
