<?php

use Application\Converters\EntityConverter;
use Application\Converters\ValueObjectConverter;
use Application\Entities\ProductEntity;
use Application\ValueObjects\ProductValueObject;

require_once '../../tests/bootstrap.php';

$pencilData = file_get_contents(APP_ROOT . '/samples/common/entities/pencil.product.json');
$pencilDataObject = json_decode($pencilData);
$pencilDataArray = json_decode($pencilData, true);

$converter = new EntityConverter(ProductEntity::class);
$voConverter = new ValueObjectConverter(ProductValueObject::class);

try {
    $vo = $voConverter->convertFromObjectToVo($pencilDataObject);
    $entity = $converter->convertFromObjectToEntity($pencilDataObject);
    var_dump(get_class($vo));
    var_dump(get_class($entity));
    // arrays
    $vo = $voConverter->convertFromArrayToVo($pencilDataArray);
    $entity = $converter->convertFromArrayToEntity($pencilDataArray);
    var_dump(get_class($vo));
    var_dump(get_class($entity));
    // entity and array
    $vo = $voConverter->convertFromEntity($entity);
    $entity = $converter->convertFromVo($vo);
    var_dump(get_class($vo));
    var_dump(get_class($entity));

    var_dump($vo);
    var_dump($entity);
} catch (ReflectionException $e) {
    exit($e->getMessage());
}


