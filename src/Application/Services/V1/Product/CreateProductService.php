<?php

declare(strict_types=1);


namespace Application\Services\V1\Product;


use Application\Application;
use Application\Entities\ProductEntity;
use Application\Exceptions\ServiceException;
use Application\Validators\CreateProductValidator;

class CreateProductService extends AbstractProductService
{
    public function __construct(Application $application)
    {
        parent::__construct($application);
        $this->validator = $application->get(CreateProductValidator::class);
    }

    public function execute(): bool
    {
        $result = false;
        try {
            $this->entity = $this->entityConverter->convertFromVo($this->valueObject);
            $result = $this->productRepository->create($this->entity);
            if (!$result) {
                throw new ServiceException('Unable to create the record');
            }
        } catch (ServiceException $exception) {
           $this->exception = $exception;
        } catch (\Exception $exception) {
            $this->exception = new ServiceException('Unable to create the record');
        }

        return $result;

    }

    public function validate(): bool
    {
        $result = $this->validator->validate();
        if (!$result) {
            $this->exception = $this->validator->getException();
        }

        return  $result;
    }


}
