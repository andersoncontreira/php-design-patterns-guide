<?php

declare(strict_types=1);


namespace Application\Converters;


use Application\Entities\EntityInterface;
use Application\Utils\ObjectUtils;
use Application\ValueObjects\ValueObjectInterface;

class ValueObjectConverter
{
    protected string $valueObjectClass;

    public function __construct(string $valueObjectClass)
    {
        $this->valueObjectClass = $valueObjectClass;
    }

    /**
     * @throws \ReflectionException
     */
    public function convertFromEntity(EntityInterface $entity): ValueObjectInterface
    {
        /** @var ValueObjectInterface $class */
        $class = new $this->valueObjectClass();
        $class->populate(ObjectUtils::toArray($entity));

        return $class;
    }

    /**
     * @throws \ReflectionException
     */
    public function convertFromObjectToVo(\stdClass $object): ValueObjectInterface
    {

        /** @var ValueObjectInterface $class */
        $class = new $this->valueObjectClass();
        $class->populate(ObjectUtils::toArray($object));

        return $class;
    }

    public function convertFromArrayToVo(array $data): ValueObjectInterface
    {

        /** @var ValueObjectInterface $class */
        $class = new $this->valueObjectClass();
        $class->populate($data);

        return $class;
    }

}
