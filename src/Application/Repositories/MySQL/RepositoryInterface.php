<?php

namespace Application\Repositories\MySQL;

use Application\Entities\EntityInterface;

interface RepositoryInterface
{
    public function getPK();

    public function find($id);

    public function findByUUID($name);

    public function list($where = null, $fields = null, $offset = null, $limit = null, $sortBy = null, $orderBy = null);

//    public function delete(EntityInterface $entity);
//
//    public function update(EntityInterface $entity);

    public function create(EntityInterface $entity);

    /**
     * @return EntityInterface[]
     * @throws \ReflectionException
     */
    public function convertList(array $items): array;

    /**
     * @param \stdClass $item
     * @return EntityInterface
     * @throws \ReflectionException
     */
    public function convertItem(\stdClass $item): EntityInterface;
}
