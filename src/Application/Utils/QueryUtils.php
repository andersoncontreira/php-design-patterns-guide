<?php

declare(strict_types=1);


namespace Application\Utils;


use Application\Repositories\MySQL\RepositoryInterface;

class QueryUtils
{

    public static function extractParams(?array $data, RepositoryInterface $repository): array
    {
        $where = isset($data['where']) ?? null;
        $fields = isset($data['fields']) ?? null;
        $offset = isset($offset) ?? PaginationUtils::OFFSET;
        $limit = isset($limit) ?? PaginationUtils::LIMIT;
        $sortBy = isset($sortBy) ?? $repository->getPK();
        $orderBy = isset($orderBy) ?? OrderUtils::ASC;

        return [$where, $fields, $offset, $limit, $sortBy, $orderBy];
    }
}
