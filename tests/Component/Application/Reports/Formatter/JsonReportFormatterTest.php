<?php

declare(strict_types=1);


namespace Application\Tests\Component\Application\Reports\Formatter;


use Application\Reports\Formatter\JsonReportFormatter;
use Application\Tests\Component\AbstractComponentTestCase;

class JsonReportFormatterTest extends AbstractComponentTestCase
{

    protected JsonReportFormatter $instance;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @dataProvider getSampleData
     * @param $sampleData
     * @return void
     */
    public function testFormat($sampleData)
    {
        $this->logger->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode($sampleData))
        );

        $this->instance = new JsonReportFormatter($sampleData);
        $json = $this->instance->format();

        $jsonSampleFileData = file_get_contents(APP_ROOT . '/tests/Datasources/reports/json/report.product.sample.json');
        $jsonSampleFileData = trim(preg_replace('/\s\s+/', '', $jsonSampleFileData));
        $jsonSampleFileData = str_replace(": ", ':', $jsonSampleFileData);
        $jsonSampleFileData = str_replace("\n", '', $jsonSampleFileData);
        $jsonSampleFileData = str_replace("\t", '', $jsonSampleFileData);
        $jsonSampleFileData = str_replace("\r", '', $jsonSampleFileData);

        $json = trim(str_replace("\n", '', $json));

        self::assertEquals($jsonSampleFileData, $json);
    }

    public function getSampleData(): array
    {
        //TODO
        //new ProductFactory()
        $sampleData = [
            "id" => 1,
            "name" => "Common Pencil",
            "supplier_id" => 1,
            "sku" => 1,
            "description" => "Common Pencil description",
            "active" => 1,
            "created_at" => "2021-08-17T14:00:00",
            "uuid" => "fecfddd9-7cb8-413b-9de3-ec86de30a888",
            "category" =>  [
                "id" => 1,
                "name" => "school supplies",
                "uuid" => "0812abaf-90fb-4877-9fe0-e2748d202584"
            ]
        ];

        return [
            [$sampleData]
        ];
    }
}
