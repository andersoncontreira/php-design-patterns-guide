<?php

declare(strict_types=1);


namespace Application\Reports\Formatter;


use Application\Interfaces\Reports\ReportFormatterInterface;

/**
 * Pattern Family: Creational
 * Pattern Name: AbstractFactory
 * Group: ReportFactory
 */
class XmlReportFormatter implements ReportFormatterInterface
{

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function format(): string
    {
        try {
            $xml = $this->toXml($this->data);
        } catch (\Exception $e) {
            $xml = new \SimpleXMLElement('<report/>');
            $xml->addChild('error', $e->getMessage());
        }

        return $xml->asXML();
    }

    /**
     * @throws \Exception
     */
    private function toXml($data, $root = null) {

        $xml = new \SimpleXMLElement($root ? '<' . $root . '/>' : '<report/>');
        if (array_key_exists(0, $data)) {
            array_walk($data, function($array, $index) use ($xml) {
                $current = $xml->addChild('item_'.$index, '');
                $this->createXmlNodes($array, $current);
            });
        } else {
            $this->createXmlNodes($data, $xml);
        }

        return $xml;
    }

    private function xmlAddChildXml($root, $new) {
        $node = $root->addChild($new->getName(), (string) $new);
        foreach($new->attributes() as $attr => $value) {
            $node->addAttribute($attr, $value);
        }
        foreach($new->children() as $ch) {
            $this->xmlAddChildXml($node, $ch);
        }
    }

    /**
     * @param $array
     * @param \SimpleXMLElement|null $current
     * @return void
     * @throws \Exception
     */
    function createXmlNodes($array, ?\SimpleXMLElement $current): void
    {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $sub = $this->toXml($v, $k);
                $this->xmlAddChildXml($current, $sub);
            } else {
                $current->addChild($k, (string)$v);
            }
        }
    }

}
