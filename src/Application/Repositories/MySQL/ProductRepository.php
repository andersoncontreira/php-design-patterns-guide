<?php

declare(strict_types=1);


namespace Application\Repositories\MySQL;


/**
 * Pattern Family: Architectural
 * Pattern Name: Repository
 * Group: Repository
 */
class ProductRepository extends AbstractRepository
{
    protected string $table = 'products';
    protected string $schema = 'store';
    protected string $tableAlias = 'p';
    protected string $pk = 'id';
    protected string $uuidKey = 'uuid';

}
