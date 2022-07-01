<?php

use Application\Enums\EntityEnum;
use Application\Factories\EntityFactory;

require_once '../../tests/bootstrap.php';


$container = new Application\Application(APP_ROOT);

$supplier = EntityFactory::factory(EntityEnum::SUPPLIER);
var_dump($supplier);

$customer = EntityFactory::factory(EntityEnum::CUSTOMER);
var_dump($customer);

$category = EntityFactory::factory(EntityEnum::CATEGORY);
var_dump($category);

try {
    $customer = EntityFactory::factory('other');
} catch (Exception $e) {
    var_dump($e);
}

