<?php

declare(strict_types=1);


namespace Application\Facades;


use Application\Application;
use Application\Converters\EntityConverter;
use Application\Entities\ProductEntity;
use Application\Exceptions\CustomException;
use Application\Services\Product\CreateProductServiceInterface;
use Application\Services\Product\DeleteProductServiceInterface;
use Application\Services\Product\ListProductServiceInterface;
use Application\Services\Product\UpdateProductServiceInterface;
use Application\Utils\OrderUtils;
use Application\Utils\PaginationUtils;
use Application\Validators\Product\CreateProductValidator;
use Application\ValueObjects\ProductValueObject;
use Monolog\Logger;

class ProductManagerFacade implements FacadeInterface
{
    protected CreateProductValidator $validator;

    protected ListProductServiceInterface $listService;
    protected CreateProductServiceInterface $createService;
    protected UpdateProductServiceInterface $updateService;
    protected DeleteProductServiceInterface $deleteService;
    protected Logger $logger;
    protected EntityConverter $entityConverter;
    protected ?CustomException $exception = null;
    protected bool $debug = false;

    public function __construct(ListProductServiceInterface $listService,
                                CreateProductServiceInterface $createService,
                                UpdateProductServiceInterface $updateService,
                                DeleteProductServiceInterface $deleteService,
                                Logger $logger,
                                EntityConverter $entityConverter=null
    )
    {
        $this->listService = $listService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->logger = $logger;

        if ($entityConverter == null) {
            $entityConverter = new EntityConverter(ProductEntity::class);
        }
        $this->entityConverter = $entityConverter;
        /** Debug info */
        $this->listService->setDebug($this->debug);
        $this->createService->setDebug($this->debug);
        $this->updateService->setDebug($this->debug);
        $this->deleteService->setDebug($this->debug);

    }

    public function list($where=[], $fields=[], $offset=PaginationUtils::OFFSET,
                         $limit=PaginationUtils::LIMIT, $orderBy=OrderUtils::ASC,
                         $sortBy=null):array
    {
        $this->logger->info(sprintf('method: %s',  __METHOD__));
        $list = [];
        $result = false;

        $data = [
            'where' => $where,
            'fields' => $fields,
            'offset' => $offset,
            'limit' => $limit,
            'orderBy' => $orderBy,
            'sortBy' => $sortBy,
        ];

        try {
            if($this->listService->validate($data)) {
                $result = $this->listService->execute($data);
                $list = $this->listService->getEntities();
            }
            if (!$result) {
                $this->exception = $this->listService->getException();
            }

        } catch (CustomException $exception) {
            $this->exception = $exception;
        }

        return $list;
    }

    public function create(ProductValueObject $valueObject): ?ProductEntity
    {
        $entity = null;
        $result = false;
        $data = [];
        try {

            //TODO melhorar via construtor e com injeção
            $this->createService->setConverter($this->entityConverter);
            $this->createService->setValueObject($valueObject);

            if ($this->createService->validate($data)) {
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

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
        /** Debug info */
        $this->listService->setDebug($this->debug);
        $this->createService->setDebug($this->debug);
        $this->updateService->setDebug($this->debug);
        $this->deleteService->setDebug($this->debug);
    }
}
