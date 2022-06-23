# Repository

Essentially, it provides an abstraction of data, so that your application can work with a simple abstraction that has an interface approximating that of a collection. Adding, removing, updating, and selecting items from this collection is done through a series of straightforward methods, without the need to deal with database concerns like connections, commands, cursors, or readers. Using this pattern can help achieve loose coupling and can keep domain objects persistence ignorant. Although the pattern is very popular (or perhaps because of this), it is also frequently misunderstood and misused. There are many different ways to implement the Repository pattern.

> More details: [Deviq.com](https://deviq.com/design-patterns/repository-pattern)

### Also known as
Repository

### Intent
> Repository layer is added between the domain and data mapping layers to isolate domain objects from details of the database access code and to minimize scattering and duplication of query code. The Repository pattern is especially useful in systems where number of domain classes is large or heavy querying is utilized.


### Diagram

[//]: # (![Diagram]&#40;../images/creational/DesignPatterns-Creational-Abstract-Factory.drawio.png&#41;)


---

### Example
Bellow you can see a code snippet of the pattern.

```php
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
```

[php file sample](../../snippets/architectural/repository.php)

> Obs: You can run it, executing the project clone.

### Sample output
Example of output:
```
result
/home/andersoncontreira/Documents/Projetos/andersoncontreira/php-design-patterns-guide/snippets/architectural/repository.php:31:
array(1) {
  [0] =>
  class Application\Entities\ProductEntity#36 (11) {
    public int $id =>
    int(1)
    public string $name =>
    string(13) "Common Pencil"
    public Application\Entities\SupplierEntity $supplier =>
    *uninitialized*
    public int $sku =>
    int(1)
    public string $description =>
    string(26) "Common Pencil description."
    public Application\Entities\CategoryEntity $category =>
    *uninitialized*
    public int $active =>
    *uninitialized*
    public DateTime $createdAt =>
    *uninitialized*
    public DateTime $updatedAt =>
    *uninitialized*
    public DateTime $deleteddAt =>
    *uninitialized*
    public string $uuid =>
    string(36) "fecfddd9-7cb8-413b-9de3-ec86de30a888"
  }
}

```

### Project example
Bellow you can see a code snippet of the pattern.
```php
```

### References
- https://deviq.com/design-patterns/repository-pattern
- https://java-design-patterns.com/patterns/repository/

---

[Return to README.md](../../README.md)
