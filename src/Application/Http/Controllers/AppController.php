<?php

declare(strict_types=1);


namespace Application\Http\Controllers;

use Application\Caching\RedisCachingClient;
use Application\Facades\HealthCheckManagerFacade;
use Application\Logger\ConsoleLogger;
use Application\Services\HealthCheck\HealthCheckService;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class AppController extends BaseController
{
    public function index(): JsonResponse
    {
        $APP_NAME = APP_NAME;
        $APP_VERSION = APP_VERSION;
        return response()->json(['app' => "${APP_NAME}:${APP_VERSION}"]);
    }

    public function alive(): JsonResponse
    {
        //return response()->json(['app' => "I'm alive!"]);
        /** @var HealthCheckManagerFacade $manager */
        //TODO
        $manager = app()->get(HealthCheckManagerFacade::class);
//        $logger = new ConsoleLogger(APP_NAME);
//        $cachingClient = new RedisCachingClient();
//        $databaseManager = app()->get('db');
//        $healthCheckService = new HealthCheckService($logger);
//        $manager = new HealthCheckManagerFacade($logger,  $cachingClient,  $databaseManager, $healthCheckService);
        return $manager->check();
    }

}
