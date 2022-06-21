<?php

declare(strict_types=1);


namespace Application\Tests\Unit\Application\Reports\Formatter;


use Application\Reports\Formatter\XmlReportFormatter;
use Application\Tests\Unit\AbstractUnitTestCase;

class XmlReportFormatterTest extends AbstractUnitTestCase
{

    protected XmlReportFormatter $instance;

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

        $this->instance = new XmlReportFormatter($sampleData);
        $xml = $this->instance->format();

        $xmlSampleFileData = file_get_contents(APP_ROOT . '/tests/Datasources/reports/xml/report.product.sample.xml');
        $xmlSampleFileData = trim(preg_replace('/\s\s+/', '', $xmlSampleFileData));
        $xmlSampleFileData = str_replace("\n", '', $xmlSampleFileData);
        $xmlSampleFileData = str_replace("\t", '', $xmlSampleFileData);
        $xmlSampleFileData = str_replace("\r", '', $xmlSampleFileData);

        $xml = trim(str_replace("\n", '', $xml));

        self::assertEquals($xmlSampleFileData, $xml);
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
