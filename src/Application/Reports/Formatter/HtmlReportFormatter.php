<?php

declare(strict_types=1);


namespace Application\Reports\Formatter;


use Application\Reports\Interfaces\ReportFormatterInterface;
use Application\Reports\ReportHelper;

/**
 * Pattern Family: Creational
 * Pattern Name: AbstractFactory
 * Group: ReportFactory
 */
class HtmlReportFormatter implements ReportFormatterInterface
{

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function format(): string
    {
        $data = $this->data;
        // start table
        $html = '<table>';
        // header row
        $html .= '<tr>';
        $keys = ReportHelper::getKeys($data);
        foreach ($keys as $key) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        // data rows
        foreach ($data as $key => $value) {
            $html .= '<tr>';
            foreach ($value as $skey => $svalue) {
                $html .= '<td>' . htmlspecialchars((string) $svalue) . '</td>';
            }
            $html .= '</tr>';
        }

        // finish table and return it
        $html .= '</table>';

        return $html;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

}
