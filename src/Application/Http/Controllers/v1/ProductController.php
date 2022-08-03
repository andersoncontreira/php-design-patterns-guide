<?php

declare(strict_types=1);


namespace Application\Http\Controllers\V1;


use Application\Facades\ProductManagerFacade;
use Application\Http\Controllers\AbstractController;
use Application\Services\Product\V1\CreateProductService;
use Application\Services\Product\V1\DeleteProductService;
use Application\Services\Product\V1\ListProductService;
use Application\Services\Product\V1\UpdateProductService;
use Application\Utils\OrderUtils;
use Application\Utils\PaginationUtils;
use Illuminate\Http\Request;
use Monolog\Logger;

class ProductController extends AbstractController
{
    public ProductManagerFacade $managerFacade;

    public function __construct(Logger $logger)
    {
        parent::__construct($logger);
        $listService = $this->application->get(ListProductService::class);
        $createService = $this->application->get(CreateProductService::class);
        $updateService = $this->application->get(UpdateProductService::class);
        $deleteService = $this->application->get(DeleteProductService::class);
        $entityConverter = null;
        $this->managerFacade = new ProductManagerFacade($listService,
                                $createService,
                                $updateService,
                                $deleteService,
                                $this->logger,
                                $entityConverter
        );
    }

    public function list(Request $request)
    {
        $where=[];
        $offset=PaginationUtils::OFFSET;
        $limit=PaginationUtils::LIMIT;
        $orderBy=OrderUtils::ASC;
        $sortBy=null;
        $fields=[];
        $this->managerFacade->list($where, $offset, $limit, $orderBy, $sortBy, $fields);
    }

    public function get()
    {

    }

    public function create()
    {

    }

    public function delete()
    {

    }

    public function update()
    {

    }

    public function softDelete()
    {

    }

}
