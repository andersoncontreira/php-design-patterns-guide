<?php

declare(strict_types=1);


namespace Application\Validators;


use Application\Exceptions\ValidatorException;
use Application\ValueObjects\ValueObjectInterface;
use Monolog\Logger;
use Respect\Validation\Rules\AbstractRule;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var ValidatorException|null
     */
    protected ?ValidatorException $exception = null;

    /**
     * @var ValueObjectInterface
     */
    protected ValueObjectInterface $valueObject;

    /**
     * @var AbstractRule[]
     */
    protected array $rules;

    /**
     * @var array
     */
    protected array $data;

    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     *
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        $this->defineRules();
    }

}
