# Builder

The builder pattern is a design pattern designed to provide a flexible solution to various object creation problems in object-oriented programming. The intent of the Builder design pattern is to separate the construction of a complex object from its representation. It is one of the Gang of Four design patterns.

> More details: [Wiki](https://en.wikipedia.org/wiki/Builder_pattern)

### Also known as
Builder

### Intent
> Separate the construction of a complex object from its representation so that the same construction process can create different representations.


### Diagram

[//]: # (![Diagram]&#40;../images/creational/DesignPatterns-Creational-Abstract-Factory.drawio.png&#41;)


---

### Example
Bellow you can see a code snippet of the pattern.

```php
<?php

use Application\Converters\ValueObjectConverter;
use Application\Enums\BrandEnum;
use Application\Enums\CurrencyEnum;
use Application\Enums\PaymentTypeEnum;
use Application\Builders\OrderSummaryBuilder;
use Application\ValueObjects\CustomerValueObject;
use Application\ValueObjects\ProductValueObject;
use Carbon\Carbon;

require_once '../../tests/bootstrap.php';

$pencilData = file_get_contents(APP_ROOT . '/samples/common/entities/pencil.product.json');
/** @var ProductValueObject $pencilVo */
$pencilVo = (new ValueObjectConverter(ProductValueObject::class))
    ->convertFromArrayToVo(json_decode($pencilData, true));
//var_dump($pencilVo);

$customerData = file_get_contents(APP_ROOT . '/samples/common/entities/alison.reid.customer.json');
/** @var CustomerValueObject $customerVo */
$customerVo = (new ValueObjectConverter(CustomerValueObject::class))
    ->convertFromArrayToVo(json_decode($customerData, true));

$customerAddressVo = $customerVo->getLocation();

$orderSummaryBuilder = New OrderSummaryBuilder();
$orderSummary = $orderSummaryBuilder->setOrderNumber(123456789)
    ->setOrderDate(Carbon::now())
    ->setCustomer($customerVo)
    ->setEstimateOrderDeliveyDate(Carbon::now()->addDays(7))
    ->setDeliveryAddress($customerAddressVo)
    ->setFleightCost(0.0, CurrencyEnum::BRL)
    ->setOrderTotalCost(99.0, CurrencyEnum::BRL)
    ->setPaymentType(PaymentTypeEnum::CREDIT_CARD, BrandEnum::MASTERCARD)
    ->setInstallments(3);

try {
    $orderSummary->build();
    var_dump($orderSummary);
} catch (ReflectionException $e) {
    exit($e->getMessage());
}

```

[php file sample](../../snippets/creational/abstract-factory.php)

### Sample output
Example of output:
```
/home/andersoncontreira/Documents/Projetos/andersoncontreira/php-design-patterns-guide/snippets/creational/builder.php:40:
class Application\Builders\OrderSummaryBuilder#75 (9) {
  protected int $orderNumber =>
  int(123456789)
  protected ?string $orderDate =>
  string(27) "2022-06-24T16:31:47.174131Z"
  protected Application\ValueObjects\CustomerValueObject $customer =>
  class Application\ValueObjects\CustomerValueObject#62 (13) {
    public string $gender =>
    string(6) "female"
    public string $title =>
    *uninitialized*
    public string $firstName =>
    *uninitialized*
    public string $lastName =>
    *uninitialized*
    public string $email =>
    string(23) "alison.reid@example.com"
    public string $username =>
    string(11) "tinywolf709"
    public string $password =>
    string(6) "rockon"
    public Application\ValueObjects\LocationValueObject $location =>
    class Application\ValueObjects\LocationValueObject#28 (9) {
      public string $street =>
      string(15) "1097 the avenue"
      public string $city =>
      string(9) "Newbridge"
      public string $state =>
      string(4) "ohio"
      public string $zip =>
      string(5) "28782"
      public int $active =>
      *uninitialized*
      public string $createdAt =>
      *uninitialized*
      public string $updatedAt =>
      *uninitialized*
      public string $deleteddAt =>
      *uninitialized*
      public string $uuid =>
      *uninitialized*
    }
    public int $active =>
    *uninitialized*
    public DateTime $createdAt =>
    *uninitialized*
    public DateTime $updatedAt =>
    *uninitialized*
    public DateTime $deleteddAt =>
    *uninitialized*
    public string $uuid =>
    *uninitialized*
  }
  protected ?string $estimateOrderDate =>
  string(27) "2022-07-01T16:31:47.175304Z"
  protected int $installments =>
  int(3)
  protected Application\ValueObjects\LocationValueObject $deliveryAddress =>
  class Application\ValueObjects\LocationValueObject#28 (9) {
    public string $street =>
    string(15) "1097 the avenue"
    public string $city =>
    string(9) "Newbridge"
    public string $state =>
    string(4) "ohio"
    public string $zip =>
    string(5) "28782"
    public int $active =>
    *uninitialized*
    public string $createdAt =>
    *uninitialized*
    public string $updatedAt =>
    *uninitialized*
    public string $deleteddAt =>
    *uninitialized*
    public string $uuid =>
    *uninitialized*
  }
  protected Application\ValueObjects\MoneyValueObject $fleightCost =>
  class Application\ValueObjects\MoneyValueObject#67 (2) {
    public string $currency =>
    string(3) "BRL"
    public float $value =>
    double(0)
  }
  protected Application\ValueObjects\PaymentTypeValueObject $paymentType =>
  class Application\ValueObjects\PaymentTypeValueObject#50 (2) {
    public ?string $paymentType =>
    string(10) "creditcard"
    public ?string $brand =>
    string(6) "master"
  }
  protected Application\ValueObjects\MoneyValueObject $orderTotalCost =>
  class Application\ValueObjects\MoneyValueObject#68 (2) {
    public string $currency =>
    string(3) "BRL"
    public float $value =>
    double(99)
  }
}

```

### Project example
Bellow you can see a code snippet of the pattern.
```php
```

### References
- https://en.wikipedia.org/wiki/Builder_pattern
- https://sourcemaking.com/design_patterns/builder
- https://java-design-patterns.com/patterns/builder
- https://refactoring.guru/design-patterns/builder

---

[Return to README.md](../../README.md)
