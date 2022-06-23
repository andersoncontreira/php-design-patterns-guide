<?php

declare(strict_types=1);


namespace Application\Converters;


use Application\Entities\EntityInterface;
use Application\Utils\ObjectUtils;
use Application\ValueObjects\ValueObjectInterface;

class EntityConverter
{
    protected string $entityClass;

    public function __construct(string $entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * @throws \ReflectionException
     */
    public function convertFromVo(ValueObjectInterface $valueObject): EntityInterface
    {
        /** @var EntityInterface $class */
        $class = new $this->entityClass();
        $class->populate(ObjectUtils::toArray($valueObject));
        return $class;
    }

    /**
     * @throws \ReflectionException
     */
    public function convertFromObjectToEntity(\stdClass $object): EntityInterface
    {
        /** @var EntityInterface $class */
        $class = new $this->entityClass();
        $class->populate(ObjectUtils::toArray($object));

        return $class;
    }

    public function convertFromArrayToEntity(array $data): EntityInterface
    {
        /** @var EntityInterface $class */
        $class = new $this->entityClass();
        $class->populate($data);

        return $class;
    }

}
