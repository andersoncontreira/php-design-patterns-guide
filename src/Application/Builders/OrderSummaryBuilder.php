<?php

declare(strict_types=1);


namespace Application\Builders;


use Application\Utils\ObjectUtils;
use Application\ValueObjects\CustomerValueObject;
use Application\ValueObjects\LocationValueObject;
use Application\ValueObjects\MoneyValueObject;
use Application\ValueObjects\Orders\OrderSummaryValueObject;
use Application\ValueObjects\PaymentTypeValueObject;
use Carbon\Carbon;

class OrderSummaryBuilder
{
    protected int $orderNumber;
    protected ?string $orderDate;
    protected CustomerValueObject $customer;
    protected ?string $estimateOrderDate;
    protected int $installments;
    protected LocationValueObject $deliveryAddress;
    protected MoneyValueObject $fleightCost;
    protected PaymentTypeValueObject $paymentType;
    protected MoneyValueObject $orderTotalCost;

    public function __construct()
    {

    }

    public function setOrderNumber(int $orderNumber): OrderSummaryBuilder
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    public function setOrderDate(Carbon $orderDate): OrderSummaryBuilder
    {
        $this->orderDate = $orderDate->toISOString();
        return $this;
    }

    public function setCustomer(CustomerValueObject $customerVo): OrderSummaryBuilder
    {
        $this->customer = $customerVo;
        return $this;
    }

    public function setEstimateOrderDeliveyDate(Carbon $estimateOrderDate): OrderSummaryBuilder
    {
        $this->estimateOrderDate = $estimateOrderDate->toISOString();
        return $this;
    }

    public function setDeliveryAddress(LocationValueObject $deliveryAddress): OrderSummaryBuilder
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    public function setFleightCost(float $value, string $curreny): OrderSummaryBuilder
    {
        $this->fleightCost = new MoneyValueObject($value, $curreny);
        return $this;
    }

    public function setOrderTotalCost(float $value, string $curreny): OrderSummaryBuilder
    {
        $this->orderTotalCost = new MoneyValueObject($value, $curreny);
        return $this;
    }

    public function setPaymentType(string $paymentType, string $brand): OrderSummaryBuilder
    {
        $this->paymentType = new PaymentTypeValueObject($paymentType, $brand);
        return $this;
    }

    public function setInstallments(int $installments): OrderSummaryBuilder
    {
        $this->installments = $installments;
        return $this;
    }

    /**
     * @throws \ReflectionException
     */
    public function build(): OrderSummaryValueObject
    {
        $data = ObjectUtils::toArray($this);
        $orderSummary = new OrderSummaryValueObject();
        $orderSummary->populate($data);

        return $orderSummary;
    }

}
