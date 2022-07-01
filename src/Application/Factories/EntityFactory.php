<?php

declare(strict_types=1);


namespace Application\Factories;


use Application\Entities\CategoryEntity;
use Application\Entities\CustomerEntity;
use Application\Entities\LocationEntity;
use Application\Entities\ProductEntity;
use Application\Entities\SupplierEntity;
use Application\Enums\EntityEnum;
use Application\Exceptions\FactoryException;

/**
 *
 */
class EntityFactory
{
    /**
     * Map of the entity classes
     * @var string[]
     */
    protected static $classMap = [
        EntityEnum::CATEGORY => CategoryEntity::class,
        EntityEnum::CUSTOMER => CustomerEntity::class,
        EntityEnum::LOCATION => LocationEntity::class,
        EntityEnum::PRODUCT => ProductEntity::class,
        EntityEnum::SUPPLIER => SupplierEntity::class
    ];

    /**
     * @throws FactoryException
     */
    public static function factory(string $entityName)
    {

        //TODO melhorar via reflection
        if (in_array($entityName, array_keys(self::$classMap))) {
            $class = self::$classMap[$entityName];
            return new $class();
        } else {
            throw new FactoryException(sprintf("Invalid entity type: %s", $entityName));
        }
    }
}
