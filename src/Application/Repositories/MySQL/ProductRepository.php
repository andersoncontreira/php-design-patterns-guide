<?php

declare(strict_types=1);


namespace Application\Repositories\MySQL;


use Application\Converters\EntityConverter;
use Application\Entities\EntityInterface;
use Application\Entities\ProductEntity;
use Application\ValueObjects\ProductValueObject;

/**
 * Pattern Family: Architectural
 * Pattern Name: Repository
 * Group: Repository
 */
class ProductRepository extends AbstractRepository
{
    protected string $table = 'products';
    protected string $schema = 'store';
    protected string $tableAlias = 'p';
    protected string $pk = 'id';
    protected string $uuidKey = 'uuid';

    /**
     * @throws \ReflectionException
     * @return EntityInterface[]
     */
    public function convertList(array $items): array
    {
        $newList = [];
        $converter = new EntityConverter(ProductEntity::class);
        foreach ($items as $item) {
            $newList[] = $converter->convertFromObjectToEntity($item);
        }
        return $newList;
    }

    /**
     * @throws \ReflectionException
     */
    public function convertItem(\stdClass $item): EntityInterface
    {
        $converter = new EntityConverter(ProductEntity::class, ProductValueObject::class);
        return $converter->convertFromObjectToEntity($item);
    }


}
