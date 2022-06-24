<?php

require_once '../../tests/bootstrap.php';

use Application\Converters\ValueObjectConverter;
use Application\Entities\ProductEntity;
use Application\Services\V1\ProductManagerFacade;
use Application\ValueObjects\ProductValueObject;

$container = new Application\Application(APP_ROOT);

$pencilData = file_get_contents(APP_ROOT . '/samples/common/entities/pencil.product.json');
$pencilVo = new ProductValueObject(json_decode($pencilData, true));

$facade = new ProductManagerFacade($container);
/** @var ProductEntity $entity */
$entity = $facade->create($pencilVo);

if (isset($entity)) {
    $id = $entity->id;
    $uuid = $entity->uuid;
    $name = $entity->name;
    $description = $entity->description;
    print("product created: $id $uuid" . PHP_EOL);
    print("product name: $name" . PHP_EOL);
    print("product description: $description" . PHP_EOL);
} else {
    $exception = $facade->getException();
    if ($exception) {
        print($exception->getMessage() . PHP_EOL);
    }
}


$entity->name = 'Pencil red';
$entity->description = 'Pencil Red description';

$converter = new ValueObjectConverter(ProductValueObject::class);
/** @var ProductValueObject $pencilVo */
$pencilVo = $converter->convertFromEntity($entity);
/** @var ProductEntity $entity */
$entity = $facade->update($pencilVo);
if (isset($entity)) {
    $id = $entity->id;
    $uuid = $entity->uuid;
    $name = $entity->name;
    $description = $entity->description;
    print("product updated: $id $uuid" . PHP_EOL);
    print("product name: $name" . PHP_EOL);
    print("product description: $description" . PHP_EOL);
} else {
    $exception = $facade->getException();
    if ($exception) {
        print($exception->getMessage() . PHP_EOL);
    }
}
