<?php

declare(strict_types=1);


namespace Application\Services\Product;


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
use Monolog\Logger;

abstract class AbstractProductService implements ServiceInterface
{
    protected ProductRepository $productRepository;
    protected RedisProductRepository $productRepositoryCache;
    protected ValidatorInterface $validator;
    protected ?CustomException $exception = null;
    protected ProductValueObject $valueObject;
    protected EntityConverter $entityConverter;
    protected EntityInterface $entity;
    protected Logger $logger;
    protected bool $debug = false;

    public function __construct(Application $application)
    {
        $this->productRepository = $application->get(ProductRepository::class);
        $this->productRepositoryCache = $application->get(RedisProductRepository::class);
        $this->logger = $application->get(Logger::class);
        /** Debug info */
        $this->productRepository->setDebug($this->debug);

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

    /**
     * @param array|null $data
     * @return bool
     */
    public function validate(array $data=null): bool
    {
        $result = $this->validator->validate($data);
        if (!$result) {
            $this->exception = $this->validator->getException();
        }

        return  $result;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
        /** Debug info */
        $this->productRepository->setDebug($this->debug);
    }
}
