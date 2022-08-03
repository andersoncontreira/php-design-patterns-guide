<?php

declare(strict_types=1);


namespace Application\Http\Controllers\V1;


use Application\Enums\Messages\MessagesEnum;
use Application\Exceptions\ApiException;
use Application\Http\ApiResponse;
use Application\Http\Controllers\AbstractController;
use Application\Utils\OrderUtils;
use Application\Utils\PaginationUtils;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * ProductController Version 1 (without categories)
 */
class ProductController extends AbstractController
{
//    public ProductManagerFacade $managerFacade;

    /**
     * @param Logger $logger
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(Logger $logger)
    {
        parent::__construct($logger);
//        $listService = $this->application->get(ListProductService::class);
//        $createService = $this->application->get(CreateProductService::class);
//        $updateService = $this->application->get(UpdateProductService::class);
//        $deleteService = $this->application->get(DeleteProductService::class);
//        $entityConverter = null;
//        $this->managerFacade = new ProductManagerFacade($listService,
//                                $createService,
//                                $updateService,
//                                $deleteService,
//                                $this->logger,
//                                $entityConverter
//        );
    }

    /**
     * @OA\Get(
     *     path="/v1/product",
     *     summary="Product List",
     *     operationId="/v1/product",
     *     description="Product List",
     *     @OA\Response(
     *          response="200",
     *          description="Success response",
     *          @OA\JsonContent(ref="#/components/schemas/HateosProductListResponseSchema")
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Error response",
     *          @OA\JsonContent(ref="#/components/schemas/ProductListErrorResponseSchema")
     *     ),
     *     @OA\Response(
     *          response="500",
     *          description="Service fail response",
     *          @OA\JsonContent(ref="#/components/schemas/ProductListErrorResponseSchema")
     *     )
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request)
    {
        $where=[];
        $offset=PaginationUtils::OFFSET;
        $limit=PaginationUtils::LIMIT;
        $orderBy=OrderUtils::ASC;
        $sortBy=null;
        $fields=[];

        $statusCode = 200;
        $response = new ApiResponse();
        $response->setHateos(true);
        try {
            throw new \Exception('Not implemented yet');
//            $list  = $this->managerFacade->list($where, $offset, $limit, $orderBy, $sortBy, $fields);
//            $count = $this->managerFacade->count($where, $offset, $limit, $orderBy, $sortBy, $fields);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
//            $managerException = $this->managerFacade->getException();
            $managerException = null;
            /* Default exception */
            $exception = new ApiException(
                MessagesEnum::LIST_ERROR['message'], MessagesEnum::LIST_ERROR['code'],
                MessagesEnum::LIST_ERROR['label'], $exception
            );
            if ($managerException)
            {
                /* Manager exception */
                $exception = $managerException;
            }
            $statusCode = 400;
            $response->setException($exception);
        }

        return $response->getResponse($statusCode);

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
