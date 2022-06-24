<?php

namespace Application\Validators;

use Application\Exceptions\ValidatorException;

interface ValidatorInterface
{

    public function getException():ValidatorException;

    public function validate():bool;
}
