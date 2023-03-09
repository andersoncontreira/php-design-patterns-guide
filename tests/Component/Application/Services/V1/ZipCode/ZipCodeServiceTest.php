<?php

namespace Application\Tests\Services\V1\ZipCode;

use Application\Services\V1\ZipCode\ZipCodeService;
use Application\Tests\Component\AbstractComponentTestCase;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ZipCodeServiceTest extends AbstractComponentTestCase
{

    protected ZipCodeService $zipCodeService;

    public function setUp(): void
    {
        parent::setUp();
        $client = new Client();
        $this->zipCodeService = new ZipCodeService($client);
    }

    /**
     * @dataProvider getCepData
     * @param $cep
     * @param $expected
     * @return void
     */
    public function testGetCepInfo($cep, $expected)
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode(func_get_args()))
        );

        var_dump($cep);

        if (!$expected && empty($cep)) {
            $this->expectException(\Exception::class);
        }

        $zipCodeData = $this->zipCodeService->getCepInfo($cep);


        //$this->assertEquals($expected, empty($zipCodeData));
        var_dump($zipCodeData);

    }

    /**
     * @return array[]
     */
    public function getCepData()
    {
        return [
            ["01001-000", true],
            ["91420-270", true],
            ["91420270", false],
            [null, false],
            ["", false],
        ];
    }

}
