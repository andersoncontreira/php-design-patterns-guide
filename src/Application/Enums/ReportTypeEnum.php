<?php

declare(strict_types=1);


namespace Application\Enums;


class ReportTypeEnum extends AbstractEnum
{
    const xml = 'xml';
    const json = 'json';
    const csv = 'csv';
    const html = 'html';
}
