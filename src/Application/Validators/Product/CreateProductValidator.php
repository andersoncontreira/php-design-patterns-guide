<?php

declare(strict_types=1);


namespace Application\Validators\Product;


use Application\Exceptions\ValidatorException;
use Application\Validators\AbstractValidator;
use Application\Validators\ValidatorInterface;
use Application\ValueObjects\ValueObjectInterface;

class CreateProductValidator extends AbstractValidator implements ValidatorInterface
{
    protected ?ValidatorException $exception = null;
    protected ValueObjectInterface $valueObject;

    public function defineRules()
    {

    }

    public function validate(array $data=null): bool
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
