<?php

require_once '../../tests/bootstrap.php';

use Application\Converters\EntityConverter;
use Application\Entities\ProductEntity;
use Application\Services\V1\Product\CreateProductService;
use Application\ValueObjects\ProductValueObject;

$container = new Application\Application(APP_ROOT);

$pencilData = file_get_contents(APP_ROOT . '/samples/common/entities/pencil.product.json');
$pencilVo = new ProductValueObject(json_decode($pencilData, true));

$entityConverter = new EntityConverter(ProductEntity::class);

$createService = new CreateProductService($container);
$createService->setValueObject($pencilVo);
$createService->setConverter($entityConverter);

$entity = null;
$result = false;
if ($createService->validate()) {
    $result = $createService->execute();
    /** @var ProductEntity $entity */
    $entity = $createService->getEntity();
}


if ($result) {
    $id = $entity->id;
    $uuid = $entity->uuid;
    $name = $entity->name;
    $description = $entity->description;
    print("product created: $id $uuid" . PHP_EOL);
    print("product name: $name" . PHP_EOL);
    print("product description: $description" . PHP_EOL);
} else {
    $exception = $createService->getException();
    if ($exception) {
        print($exception->getMessage() . PHP_EOL);
    }
}
