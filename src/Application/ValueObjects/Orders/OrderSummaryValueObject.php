<?php

declare(strict_types=1);


namespace Application\ValueObjects\Orders;



use Application\ValueObjects\AbstractValueObject;
use Application\ValueObjects\CustomerValueObject;
use Application\ValueObjects\LocationValueObject;
use Application\ValueObjects\MoneyValueObject;
use Application\ValueObjects\PaymentTypeValueObject;
use Application\ValueObjects\ValueObjectInterface;

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

    public static array $map = [
        'customer' => CustomerValueObject::class,
        'deliveryAddress' => LocationValueObject::class,
        'fleightCost' => MoneyValueObject::class,
        'orderTotalCost' => MoneyValueObject::class,
        'paymentType' => PaymentTypeValueObject::class
    ];

    public function populate(array $data = null)
    {
        parent::populate($data);

        //TODO repassar para a Abstract
        foreach ($data as $key => $value) {
            if (in_array($key, array_keys(self::$map))) {
                $valueObjectClass = self::$map[$key];
                /** @var ValueObjectInterface $vo */
                $vo = new $valueObjectClass();
                $vo->populate($value);
                $this->$key = $vo;

            }
        }
    }
}
