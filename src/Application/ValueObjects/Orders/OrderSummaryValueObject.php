<?php

declare(strict_types=1);


namespace Application\ValueObjects\Orders;



use Application\ValueObjects\AbstractValueObject;
use Application\ValueObjects\CustomerValueObject;
use Application\ValueObjects\LocationValueObject;
use Application\ValueObjects\MoneyValueObject;
use Application\ValueObjects\PaymentTypeValueObject;

class OrderSummaryValueObject extends AbstractValueObject
{

    public int $orderNumber;
    public ?string $orderDate;
    public CustomerValueObject $customer;
    public ?string $estimateOrderDate;
    public LocationValueObject $deliveryAddress;
    public MoneyValueObject $fleightCost;
    public MoneyValueObject $orderTotalCost;
    public PaymentTypeValueObject $paymentType;
    public int $installments;
}
