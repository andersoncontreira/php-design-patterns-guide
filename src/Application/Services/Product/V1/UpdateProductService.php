<?php

declare(strict_types=1);


namespace Application\Services\Product\V1;


use Application\Application;
use Application\Entities\ProductEntity;
use Application\Exceptions\ServiceException;
use Application\Services\Product\AbstractProductService;
use Application\Services\Product\UpdateProductServiceInterface;
use Application\Validators\Product\UpdateProductValidator;

class UpdateProductService extends AbstractProductService implements UpdateProductServiceInterface
{
    public function __construct(Application $application)
    {
        parent::__construct($application);
        $this->validator = $application->get(UpdateProductValidator::class);
    }

    public function execute(array $data=null): bool
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


}
