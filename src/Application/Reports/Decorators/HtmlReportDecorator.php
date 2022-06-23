<?php

declare(strict_types=1);


namespace Application\Reports\Decorators;


use Application\Reports\Interfaces\ReportDecoratorInterface;

class HtmlReportDecorator implements ReportDecoratorInterface
{

    public function decorate(array $data): array
    {
        $new = [];
        foreach ($data as $item) {
            $new[] = to_array($item);
        }
        return $new;
    }
}
