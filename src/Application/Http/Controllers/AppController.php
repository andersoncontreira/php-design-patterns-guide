<?php

declare(strict_types=1);


namespace Application\Http\Controllers;

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
        //TODO implementar health check inteligente
        return response()->json(['app' => "I'm alive!"]);
    }

}
