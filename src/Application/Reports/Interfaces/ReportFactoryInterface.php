<?php

declare(strict_types=1);

namespace Application\Reports\Interfaces;


interface ReportFactoryInterface
{
    public function createFormatter(array $data): ReportFormatterInterface;
    public function createDecorator(): ReportDecoratorInterface;
}

