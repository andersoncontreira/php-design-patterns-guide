<?php

declare(strict_types=1);


namespace Application\Repositories;

use Illuminate\Database\DatabaseManager;

/**
 * Pattern Family: Architectural
 * Pattern Name: Repository
 * Group: Repository
 */
abstract class AbstractRepository
{
    protected DatabaseManager $manager;

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    public function get()
    {

    }

    public function list()
    {

    }

    public function find()
    {

    }



}
