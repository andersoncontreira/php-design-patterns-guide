<?php

declare(strict_types=1);


namespace Application\Exceptions;


use Throwable;

class CustomException extends \Exception implements Throwable
{
    protected string $label;
    protected ?array $params;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return array|null
     */
    public function getParams(): ?array
    {
        return $this->params;
    }
}
