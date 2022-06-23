<?php

require_once '../../tests/bootstrap.php';

use Application\Entities\ProductEntity;
use Application\Repositories\MySQL\ProductRepository;

$container = new Application\Application(APP_ROOT);

/** @var ProductRepository $repository */
$repository = $container->get(ProductRepository::class);

$pencilData = file_get_contents(APP_ROOT . '/samples/common/entities/pencil.product.json');
$pencil = new ProductEntity(json_decode($pencilData, true));

$penData = file_get_contents(APP_ROOT . '/samples/common/entities/pen.product.json');
$pen = new ProductEntity(json_decode($penData, true));

$repository->create($pencil);
$repository->create($pen);

$where = null;
$fields = null;
$offset = null;
$limit = 2;
$sortBy = null;
$orderBy = null;
$result = $repository->list($where, $fields, $offset, $limit, $sortBy, $orderBy);

print('result' . PHP_EOL);
var_dump($result);

