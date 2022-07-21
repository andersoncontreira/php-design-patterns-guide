<?php

declare(strict_types=1);


namespace Application\Utils;


final class HttpUtils
{
    const CUSTOM_DEFAULT_HEADERS = [
        'Content-Type'=> 'application/json',
        'Custom-Arch-Version'=> APP_ARCH_VERSION,
        'Custom-Service-Version'=> APP_VERSION,
        'Access-Control-Allow-Origin'=> '*',
        'Access-Control-Allow-Methods'=> 'OPTIONS, GET, POST, PATH, PUT, DELETE',
        # 'Access-Control-Allow-Headers'=> 'Content-Type'
    ];

    private function __construct()
    {
    }

}
