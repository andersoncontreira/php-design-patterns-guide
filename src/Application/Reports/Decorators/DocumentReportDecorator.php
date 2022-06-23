<?php

declare(strict_types=1);


namespace Application\Reports\Decorators;


use Application\Reports\Interfaces\ReportDecoratorInterface;
use Application\Reports\ReportHelper;

abstract class DocumentReportDecorator
{

    public function decorate(array $data): array
    {
        $new = [];
        $keys = ReportHelper::getKeys($data);
        $values = ReportHelper::getValues($data);
        $new['schema'] = [];
        for ($i =0; $i < count($values); $i++) {
            $key = array_key_exists($i, $keys)? $keys[$i] : $i;
            $value = array_key_exists($i, $values)? $values[$i] : $i;
            $new['schema'][$key] = gettype($value);
        }

        foreach ($data as $item) {
            $new['documents'][] = to_array($item);
        }
        return $new;
    }
}
