<?php

declare(strict_types=1);


namespace Application\Reports\Datasources;


use Application\Interfaces\Reports\ReportDatasourceInterface;
use Application\Interfaces\RepositoryInterface;

class DatabaseDatasource implements ReportDatasourceInterface
{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getData(): array
    {
        //$where = null, $fields = null, $offset=null, $limit=null, $sortBy=null, $orderBy=null
        return $this->repository->list();
    }
}
