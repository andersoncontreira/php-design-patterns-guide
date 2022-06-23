<?php

namespace Application\Reports\Interfaces;

interface ReportDecoratorInterface
{
    public function decorate(array $data):array;
}
