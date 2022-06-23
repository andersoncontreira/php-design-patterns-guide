<?php

namespace Application\Repositories\MySQL;

interface RepositoryInterface
{
    public function find($id);

    public function findByUUID($name);

    public function list($where = null, $fields = null, $offset=null, $limit=null, $sortBy=null, $orderBy=null);

//    public function delete($entity);
//
//    public function update($entity);
//
//    public function create($entity);

}
