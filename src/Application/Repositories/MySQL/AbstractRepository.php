<?php

declare(strict_types=1);


namespace Application\Repositories\MySQL;

use Application\Converters\EntityConverter;
use Application\Entities\EntityInterface;
use Application\Utils\Pagination;
use Illuminate\Database\DatabaseManager;
use Monolog\Logger;

/**
 * Pattern Family: Architectural
 * Pattern Name: Repository
 * Group: Repository
 */
abstract class AbstractRepository implements RepositoryInterface
{


    protected DatabaseManager $manager;
    protected Logger $logger;
    protected string $table;
    protected string $schema;
    protected string $tableAlias;
    protected string $pk;
    protected string $uuidKey;
    protected \Exception $exception;

    public function __construct(DatabaseManager $manager, Logger $logger)
    {
        $this->manager = $manager;
        $this->logger = $logger;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function findByUUID($name)
    {
        // TODO: Implement findByUUID() method.
    }

    public function get($value, $key, $where = null, $fields = null)
    {
    }

    public function create(EntityInterface $entity):bool
    {

        return true;
    }

    public function list($where = null, $fields = null, $offset = null, $limit = null, $sortBy = null, $orderBy = null)
    {

        if ($limit == null) {
            $limit = Pagination::LIMIT;
        }

        if ($offset == null) {
            $offset = Pagination::OFFSET;
        }

        if ($fields == null) {
            $fields = '*';
        }
        $tmp = $fields == '*' ? ['*'] : explode(',', $fields);
        $fields = [];
        foreach ($tmp as $f) {
            $fields[] = trim($f);
        }


        $query = $this->manager->table($this->table, $this->tableAlias);
        $query->select($fields)->offset($offset)->limit($limit);

        if ($orderBy != null) {
            $query->orderBy($orderBy);
        }

        $result = null;
        try {
            $cursor = $query->cursor();
            $result = $cursor->all();
            $result = $this->convertList($result);
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->exception = $e;
        }

        return $result;
    }
}
