<?php

declare(strict_types=1);


namespace Application\ValueObjects;


use Application\Enums\CurrencyEnum;
use Application\Utils\ObjectUtils;

class MoneyValueObject extends AbstractValueObject
{
    public string $currency;
    public float $value;

    public function __construct(float $value = 0.0, string $currency = CurrencyEnum::BRL)
    {
        $this->value = $value;
        $this->currency = $currency;
    }
}
