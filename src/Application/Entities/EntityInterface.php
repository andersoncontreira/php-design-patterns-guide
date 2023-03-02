<?php

namespace Application\Entities;

interface EntityInterface
{
    public function populate(array $data);

    public function toArray();
}
