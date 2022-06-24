<?php

namespace Application\Services;

interface ServiceInterface
{

    /**
     * Method validate to check de data integrity
     * @return bool
     *
     */
    public function validate(): bool;
    /**
     * Method execute
     * @return bool
     *
     */
    public function execute(): bool;
}
