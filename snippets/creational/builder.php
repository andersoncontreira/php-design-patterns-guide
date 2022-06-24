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



