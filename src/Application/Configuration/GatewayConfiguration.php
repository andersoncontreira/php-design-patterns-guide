<?php

declare(strict_types=1);


namespace Application\Configuration;


class GatewayConfiguration extends AbstractConfiguration
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->configuration = [
            'default' => env('DEFAULT_GATEWAY', 'cielo'),
            'cielo' => [
                'id' => env('CIELO_CLIENT_ID',''),
                'key' => env('CIELO_CLIENT_KEY', ''),
            ],
            'paypal' => [
                'id' => env('PAYPAL_CLIENT_ID', ''),
                'key' => env('PAYPAL_CLIENT_KEY', ''),
            ]
        ];
    }

}
