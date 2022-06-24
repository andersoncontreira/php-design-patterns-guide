<?php

declare(strict_types=1);


namespace Application\Services\V1\Product;


use Application\Application;
use Application\Converters\EntityConverter;
use Application\Entities\EntityInterface;
use Application\Entities\ProductEntity;
use Application\Exceptions\CustomException;
use Application\Repositories\MySQL\ProductRepository;
use Application\Repositories\Redis\ProductRepository as RedisProductRepository;
use Application\Services\ServiceInterface;
use Application\Validators\CreateProductValidator;
use Application\Validators\ValidatorInterface;
use Application\ValueObjects\ProductValueObject;

abstract class AbstractProductService implements ServiceInterface
{
    protected ProductRepository $productRepository;
    protected RedisProductRepository $productRepositoryCache;
    protected ValidatorInterface $validator;
    protected ?CustomException $exception = null;
    protected ProductValueObject $valueObject;
    protected EntityConverter $entityConverter;
    protected EntityInterface $entity;

    public function __construct(Application $application)
    {
        $this->productRepository = $application->get(ProductRepository::class);
        $this->productRepositoryCache = $application->get(RedisProductRepository::class);
    }

    /**
     * @param EntityConverter $entityConverter
     * @return void
     */
    public function setConverter(EntityConverter $entityConverter)
    {
        $this->entityConverter = $entityConverter;
    }

    /**
     * @param ProductValueObject $valueObject
     */
    public function setValueObject(ProductValueObject $valueObject): void
    {
        $this->valueObject = $valueObject;
        $this->validator->setValueObject($valueObject);
    }

    /**
     * @return EntityInterface
     */
    public function getEntity(): EntityInterface
    {
        return $this->entity;
    }

    /**
     * @return CustomException|null
     */
    public function getException(): ?CustomException
    {
        return $this->exception;
    }
}
