<?php

namespace Application\Services\V1\ZipCode;

use GuzzleHttp\Client;

class ZipCodeService
{
    protected Client $client;

    public function __construct(Client $httpClient)
    {
        $this->client = $httpClient;
    }

    public function getCepInfo($cep)
    {
        if (empty($cep)) {
            throw new \Exception('Invalid param');
        }
        $zipCodeData = [];
//        $response = $this->client->get(sprintf('/ceps/%s', $cep));


        return $zipCodeData;
    }
}
