<?php

declare(strict_types=1);


namespace Application\Reports;


class ReportHelper
{

    public static function getKeys(array $data)
    {
        if (array_key_exists(0, $data)) {
            $item = to_array($data[0]);
        } else {
            $item = to_array($data);
        }
        return array_keys($item);
    }

    public static function getValues(array $data)
    {
        if (array_key_exists(0, $data)) {
            $item = to_array($data[0]);
        } else {
            $item = to_array($data);
        }
        return array_values($item);
    }
}
