<?php

declare(strict_types=1);


namespace Application\Repositories\MySQL;

use Application\Converters\EntityConverter;
use Application\Entities\EntityInterface;
use Application\Utils\PaginationUtils;
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
    protected bool $debug = false;

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
            $limit = PaginationUtils::LIMIT;
        }

        if ($offset == null) {
            $offset = PaginationUtils::OFFSET;
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

        var_dump('aq', $this->debug);
        var_dump($query->toSql());
        $result = null;
        try {
            if ($this->debug) {
                $this->logger->debug($query->toSql());
                $this->logger->info($query->toSql());
            }
            $cursor = $query->cursor();
            $result = $cursor->all();
            $result = $this->convertList($result);
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->exception = $e;
        }

        return $result;
    }

    public function getPK(): string
    {
        return $this->pk;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }
}
