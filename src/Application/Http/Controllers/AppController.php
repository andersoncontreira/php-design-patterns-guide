<?php

declare(strict_types=1);


namespace Application\Http\Controllers;

use Application\Enums\HealthStatus;
use Application\Facades\HealthCheckManagerFacade;
use Application\HealthCheck\HealthCheckResponse;
use Illuminate\Http\JsonResponse;

/**
 * Base API Controller
 * Contains the root path and alive check
 */
class AppController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/",
     *     summary="Root endpoint",
     *     operationId="/",
     *     description="Get the app name and version",
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
     * @OA\Get(
     *     path="/alive",
     *     summary="Service Health Method",
     *     operationId="/alive",
     *     description="Check if the application are running well",
     *     @OA\Response(
     *          response="200",
     *          description="Success response",
     *          @OA\JsonContent(ref="#/components/schemas/HealthCheckSchema")
     *     ),
     *     @OA\Response(
     *          response="424",
     *          description="Failed dependency response",
     *          @OA\JsonContent(ref="#/components/schemas/DegradedCheckSchema")
     *     ),
     *     @OA\Response(
     *          response="503",
     *          description="Service unavailable response",
     *          @OA\JsonContent(ref="#/components/schemas/UnhealthyCheckSchema")
     *     )
     * )
     * @return JsonResponse
     */
    public function alive(): JsonResponse
    {
        /** @var HealthCheckManagerFacade $manager */
        try {
            //TODO to fix
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
