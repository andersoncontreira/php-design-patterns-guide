# Service Layer

Service layer is an architectural pattern, applied within the service-orientation design paradigm, which aims to organize the services, within a service inventory, into a set of logical layers. Services that are categorized into a particular layer share functionality. This helps to reduce the conceptual overhead related to managing the service inventory, as the services belonging to the same layer address a smaller set of activities.

> More details: [Wiki](https://en.wikipedia.org/wiki/Service_layer_pattern)

### Also known as
Façade

### Intent
> Service Layer is an abstraction over domain logic. It defines application's boundary with a layer of services that establishes a set of available operations and coordinates the application's response in each operation.


### Diagram

[//]: # (![Diagram]&#40;../images/creational/DesignPatterns-Creational-Abstract-Factory.drawio.png&#41;)

---

### Example
Bellow you can see a code snippet of the pattern.

```php
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


```

[php file sample](../../snippets/architectural/service-layer.php)

> Obs: You can run it, executing the project clone.

### Sample output
Example of output:
```
product created: 1 fecfddd9-7cb8-413b-9de3-ec86de30a888
product name: Common Pencil
product description: Common Pencil description
```

### Project example
Bellow you can see a code snippet of the pattern.
```php
```


### References
- https://en.wikipedia.org/wiki/Service_layer_pattern
- https://java-design-patterns.com/patterns/service-layer/

---

[Return to README.md](../../README.md)

