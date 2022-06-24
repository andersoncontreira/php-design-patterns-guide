<?php

declare(strict_types=1);


namespace Application\ValueObjects;


use Application\Utils\ObjectUtils;

class PaymentTypeValueObject extends AbstractValueObject
{
    public ?string $paymentType;
    public ?string $brand;

    public function __construct(string $paymentType = null, string $brand = null)
    {
        $this->paymentType = $paymentType;
        $this->brand = $brand;
    }

}
