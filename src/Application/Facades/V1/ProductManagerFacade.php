<?php

declare(strict_types=1);


namespace Application\Facades\V1;


use Application\Application;
use Application\Converters\EntityConverter;
use Application\Entities\ProductEntity;
use Application\Exceptions\CustomException;
use Application\Facades\FacadeInterface;
use Application\Repositories\MySQL\ProductRepository;
use Application\Repositories\Redis\ProductRepository as RedisProductRepository;
use Application\Services\ServiceInterface;
use Application\Services\V1\Product\CreateProductService;
use Application\Services\V1\Product\UpdateProductService;
use Application\Validators\CreateProductValidator;
use Application\ValueObjects\ProductValueObject;

class ProductManagerFacade implements FacadeInterface
{
    protected CreateProductValidator $validator;
    protected CreateProductService $createService;
    protected UpdateProductService $updateService;
    protected EntityConverter $entityConverter;
    protected ?CustomException $exception = null;


    public function __construct(Application $application, EntityConverter $entityConverter = null)
    {
        $this->createService = $application->get(CreateProductService::class);
        $this->updateService = $application->get(UpdateProductService::class);

        if ($entityConverter == null) {
            $entityConverter = new EntityConverter(ProductEntity::class);
        }
        $this->entityConverter = $entityConverter;

    }

    public function create(ProductValueObject $valueObject): ?ProductEntity
    {
        $entity = null;
        $result = false;
        try {

            //TODO melhorar via construtor e com injeção
            $this->createService->setConverter($this->entityConverter);
            $this->createService->setValueObject($valueObject);

            if ($this->createService->validate()) {
                $result = $this->createService->execute();
                /** @var ProductEntity $entity */
                $entity = $this->createService->getEntity();
            }

            if (!$result) {
                $this->exception = $this->createService->getException();
            }
        } catch (CustomException $exception) {
            $this->exception = $exception;
        }

        return $entity;
    }

    /**
     * @return CustomException|null
     */
    public function getException(): ?CustomException
    {
        return $this->exception;
    }

    public function update(ProductValueObject $valueObject): ?ProductEntity
    {
        $entity = null;
        $result = false;
        try {

            $this->updateService->setConverter($this->entityConverter);
            $this->updateService->setValueObject($valueObject);

            if ($this->updateService->validate()) {
                $result = $this->updateService->execute();
                /** @var ProductEntity $entity */
                $entity = $this->updateService->getEntity();
            }

            if (!$result) {
                $this->exception = $this->updateService->getException();
            }
        } catch (CustomException $exception) {
            $this->exception = $exception;
        }

        return $entity;
    }
}
