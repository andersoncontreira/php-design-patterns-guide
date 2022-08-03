<?php

declare(strict_types=1);


namespace Application\Validators\Product;


use Application\Entities\ProductEntity;
use Application\Enums\Messages\MessagesEnum;
use Application\Exceptions\CustomException;
use Application\Exceptions\ValidatorException;
use Application\Utils\OrderUtils;
use Application\Validators\AbstractValidator;
use Application\Validators\ValidatorInterface;
use Application\ValueObjects\ValueObjectInterface;
use Nette\Schema\Elements\AnyOf;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Between;
use Respect\Validation\Rules\In;
use Respect\Validation\Rules\Min;
use Respect\Validation\Rules\Numeric;
use Respect\Validation\Validator;

class ListProductValidator extends AbstractValidator implements ValidatorInterface
{
    public function defineRules()
    {
//        $where = new AnyOf();

        $limit = new AllOf(
            new Numeric(),
            new Between(1, 100)
        );
        $offset = new AllOf(
            new Numeric(),
            new Min(0)
        );
        $sortBy = Validator::when(Validator::stringType(),
            new In(ProductEntity::getAttributes()), Validator::nullType()
        );

        $fields = Validator::when(Validator::arrayType(),
            new In(ProductEntity::getAttributes()), Validator::nullType()
        );

        $orderBy = new AllOf(
            new In(OrderUtils::ASC, OrderUtils::DESC)
        );

        $this->rules = [
//            'where' => $where,
            'limit' => $limit,
            'offset' => $offset,
            'orderBy' => $orderBy,
            'sortBy' => $sortBy,
            'fields' => $fields
        ];
    }

    public function validate(array $data): bool
    {
        $result = false;
        $errorMessage = null;
        $exception = null;
        try {
            foreach ($this->rules as $key => $rules) {

                $fieldData = $data[$key] ?? null;
                $result = $rules->validate($fieldData);
                if (!$result) {
                    $errorMessage = sprintf('Key %s contains invalid data', $key);
                    throw new ValidatorException($errorMessage, MessagesEnum::LIST_ERROR['code']);
                }
            }

            $result = true;
        } catch (CustomException $exception) {
            $this->logger->error($exception->getMessage());
            $errorMessage = sprintf('%s - %s', MessagesEnum::LIST_ERROR['message'], $exception->getMessage());
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
            $errorMessage = MessagesEnum::LIST_ERROR['message'];
        }

        if ($errorMessage)
        {
            $this->exception = new ValidatorException(
                $errorMessage, MessagesEnum::LIST_ERROR['code'], $exception);
        }

        return $result;
    }

    public function getException(): ValidatorException
    {
        return $this->exception;
    }

    /**
     * @param ValueObjectInterface $valueObject
     */
    public function setValueObject(ValueObjectInterface $valueObject): void
    {
        $this->valueObject = $valueObject;
    }
}
