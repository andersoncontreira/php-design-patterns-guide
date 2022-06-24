# Facade

The facade pattern (also spelled façade) is a software-design pattern commonly used in object-oriented programming. Analogous to a facade in architecture, a facade is an object that serves as a front-facing interface masking more complex underlying or structural code. A facade can:

improve the readability and usability of a software library by masking interaction with more complex components behind a single (and often simplified) API
provide a context-specific interface to more generic functionality (complete with context-specific input validation)
serve as a launching point for a broader refactor of monolithic or tightly-coupled systems in favor of more loosely-coupled code

> More details: [Wiki](https://en.wikipedia.org/wiki/Facade_pattern)

### Also known as
Façade

### Intent
> Provide a unified interface to a set of interfaces in a subsystem. Facade defines a higher-level interface that makes the subsystem easier to use.


### Diagram

[//]: # (![Diagram]&#40;../images/creational/DesignPatterns-Creational-Abstract-Factory.drawio.png&#41;)

---

### Example
Bellow you can see a code snippet of the pattern.

```php
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

```

[php file sample](../../snippets/structural/facade.php)

> Obs: You can run it, executing the project clone.

### Sample output
Example of output:
```
product created: 1 fecfddd9-7cb8-413b-9de3-ec86de30a888
product name: Common Pencil
product description: Common Pencil description
product updated: 1 fecfddd9-7cb8-413b-9de3-ec86de30a888
product name: Pencil red
product description: Pencil Red description
```

### Project example
Bellow you can see a code snippet of the pattern.
```php
```


### References
- https://en.wikipedia.org/wiki/Facade_pattern
- https://sourcemaking.com/design_patterns/facade
- https://java-design-patterns.com/patterns/facade
- https://refactoring.guru/pt-br/design-patterns/facade

---

[Return to README.md](../../README.md)

