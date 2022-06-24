<?php

declare(strict_types=1);


namespace Application\Validators;


use Application\Exceptions\ValidatorException;
use Application\ValueObjects\ValueObjectInterface;

class UpdateProductValidator implements ValidatorInterface
{
    protected ?ValidatorException $exception = null;
    protected ValueObjectInterface $valueObject;


    public function validate(): bool
    {
        $result = false;

        try {
            //TODO implementar
            $result = true;
        } catch (\Exception $exception) {
            $this->exception = new ValidatorException('Validation error');
        }

        return $result;
    }

    public function getException(): ValidatorException
    {
        return $this->exception;
    }

    /**
     * @param ValueObjectInterface $valueObject
     */
    public function setValueObject(ValueObjectInterface $valueObject): void
    {
        $this->valueObject = $valueObject;
    }
}
