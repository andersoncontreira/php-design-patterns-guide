<?php

namespace Application\Services;

interface ServiceInterface
{

    /**
     * Method validate to check de data integrity
     * @return bool
     *
     */
    public function validate(array $data=null): bool;
    /**
     * Method execute
     * @return bool
     *
     */
    public function execute(array $data=null): bool;

    /**
     * Define if the class will print debug logs
     * @param bool $debug
     * @return mixed
     */
    public function setDebug(bool $debug);
}
