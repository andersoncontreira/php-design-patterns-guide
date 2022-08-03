<?php

declare(strict_types=1);


namespace Application\Http\Controllers;
use Application\Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Laravel\Lumen\Routing\Controller as BaseController;
use Monolog\Logger;

/**
 * @OA\Info(
 *   title="PHP Design Patterns Guide API",
 *   version="1.0"
 * )
 */
class AbstractController extends BaseController
{
    protected ?Logger $logger = null;

    protected ?Application $application = null;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        $this->application = app();
    }
}
