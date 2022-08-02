<?php

declare(strict_types=1);


namespace Application\Http\Controllers;

use Application\Enums\HealthStatus;
use Application\Facades\HealthCheckManagerFacade;
use Application\HealthCheck\HealthCheckResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Base API Controller
 * Contains the root path and alive check
 */
class AppController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/",
     *     operationId="/",
     *     description="Root endpoint",
     *     @OA\Response(
     *          response="200",
     *          description="Success response",
     *          @OA\JsonContent(ref="#/components/schemas/RootSchema")
     *     )
     * )
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $APP_NAME = APP_NAME;
        $APP_VERSION = APP_VERSION;
        return response()->json(['app' => "${APP_NAME}:${APP_VERSION}"]);
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function alive(): JsonResponse
    {
        /** @var HealthCheckManagerFacade $manager */
        try {
            $manager = app()->get(HealthCheckManagerFacade::class);
            return $manager->check();
        } catch (\Throwable $e) {
            $this->logger->error($e);
            $response = new HealthCheckResponse($this->logger);
            $response->setException($e);
            $response->setStatusCode(503);
            $response->setStatus(HealthStatus::UNHEALTHY);
            return $response->getResponse();
        }
    }

}
