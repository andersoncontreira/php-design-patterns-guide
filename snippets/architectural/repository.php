<?php

require_once '../../tests/bootstrap.php';

use Application\Converters\EntityConverter;
use Application\Entities\ProductEntity;
use Application\Repositories\MySQL\ProductRepository;
use Application\ValueObjects\ProductValueObject;

$container = new Application\Application(APP_ROOT);

/** @var ProductRepository $repository */
$repository = $container->get(ProductRepository::class);
$conveter = new EntityConverter(ProductEntity::class);

$pencilData = file_get_contents(APP_ROOT . '/samples/common/entities/pencil.product.json');
$pencilVo = new ProductValueObject(json_decode($pencilData, true));
$pencil = $conveter->convertFromVo($pencilVo);

$penData = file_get_contents(APP_ROOT . '/samples/common/entities/pen.product.json');
$penVo = new ProductValueObject(json_decode($penData, true));
$pen = $conveter->convertFromVo($pencilVo);


$created = $repository->create($pencil);
$created = $created ? 'true': 'false';
print('created: ' . $created . PHP_EOL);

$created = $repository->create($pen);
$created = $created ? 'true': 'false';
print('created: ' . $created . PHP_EOL);

$where = null;
$fields = null;
$offset = null;
$limit = 2;
$sortBy = null;
$orderBy = null;
$result = $repository->list($where, $fields, $offset, $limit, $sortBy, $orderBy);

print('result' . PHP_EOL);
var_dump($result);

